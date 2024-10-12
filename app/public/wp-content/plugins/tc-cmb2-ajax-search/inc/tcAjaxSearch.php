<?php


class tcAjaxSearch
{
    const TC_AJAX_SEARCH_FIELD_TYPE_NAME = 'tc_ajax_search';


    /**
     * @var
     */
    private static $instance;

    /**
     * @return self
     */
    public static function init()
    {
        if (is_null(static::$instance)) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * myEstroConnectorBaseClass constructor.
     */
    protected function __construct()
    {


        $this->addActions();
        $this->addFilters();


    }

    /** Metodo base per registrare actions
     *
     */
    protected static function addActions()
    {
        add_action('admin_enqueue_scripts', [self::class, 'tcAdminAssetsRegister'], 10);
        add_action('admin_enqueue_scripts', [self::class, 'tcAdminAssetsEnqueue'], 11);
        add_action('wp_ajax_tc_ajax_search', [self::class, 'tcAjaxSearch']);
        add_action('wp_ajax_nopriv_tc_ajax_search', [self::class, 'tcAjaxSearch']);
        add_action('cmb2_render_' . self::TC_AJAX_SEARCH_FIELD_TYPE_NAME, [self::class, 'tcRenderAjaxSearchField'], 10, 5);

    }

    /** Metodo base per registrare filters
     *
     */
    protected static function addFilters()
    {


        add_filter('cmb2_sanitize_' . self::TC_AJAX_SEARCH_FIELD_TYPE_NAME, [self::class, 'tcSanitizeAjaxSearchField'], 10, 5);
        add_filter('cmb2_types_esc_' . self::TC_AJAX_SEARCH_FIELD_TYPE_NAME, [self::class, 'tcEscapeAjaxSearchField'], 10, 5);

    }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//    ASSETS METHODS
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------


    /** Callback per registrare assets all'interno del wp-admin
     *  Hook:admin_enqueue_scripts
     */
    public static function tcAdminAssetsRegister()
    {
        wp_register_script('tc-ajax-search', TC_AJAX_SEARCH_BASE_URL . '/assets/js/tc-cmb2-ajax-search.js', ['jquery-core'], TC_AJAX_SEARCH_VERSION, false);
        wp_register_style('tc-ajax-search', TC_AJAX_SEARCH_BASE_URL . '/assets/css/tc-cmb2-ajax-search.css', [], TC_AJAX_SEARCH_VERSION);

    }


    /** Callback per accodare assets all'interno del wp-admin
     *  Hook:admin_enqueue_scripts
     */
    public static function tcAdminAssetsEnqueue()
    {
        wp_enqueue_script('tc-ajax-search');
        wp_enqueue_style('tc-ajax-search');

    }
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//    FIELD RENDERING/SANITIZING/ESCAPING
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

    public static function tcRenderAjaxSearchField($field, $escaped_value, $object_id, $object_type, $field_type_object)
    {

        include TC_AJAX_SEARCH_BASE_PATH . '/views/tc-ajax-search-field.php';

    }


    public static function tcSanitizeAjaxSearchField($override_value, $value, $object_id, $field_args, $sanitize_object)
    {
        $emptyValue = [
            'display' => '',
            'value' => ''
        ];


        if (is_array($value) && $field_args['repeatable']) {


            foreach ($value as $key => &$val) {
                if (empty($val) || empty($val['value']) || empty($val['display']) || is_null(get_post($val['value']))) {
                    unset($value[$key]);

                }
            }

            return $value;
        } else {
            if (empty($value) || empty($value['value']) || empty($value['display'])) return $emptyValue;
            if (is_null(get_post($value['value']))) return $emptyValue;
            return $value;

        }
    }


    public static function tcEscapeAjaxSearchField($check, $meta_value, $field_args, $field_object)
    {
        if (is_array($meta_value) && $field_args['repeatable']) {
            foreach ($meta_value as $key => $val) {
                $meta_value[$key] = array_map('esc_attr', $val);
            }

            return $meta_value;
        }
        return $check;
    }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//   AJAX SEARCH
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

    public static function tcAjaxSearch()
    {

        $postType = $_POST['query'];
        $searchTerm = $_POST['search_term'];
        $tcFieldID = $_POST['tcID'];
        $queryString = $_POST['queryStringParams'];
        if (!empty($searchTerm)) {
            global $wpdb;
            $sql = $wpdb->prepare(
                'SELECT * FROM %1$s WHERE post_type = "%2$s" AND post_status="publish" AND post_title LIKE "%3$s"', $wpdb->posts,
                $postType, '%' . $searchTerm . '%'

            );
            $sql = apply_filters('tc_cmb2_ajax_search_filter_query', $sql, $tcFieldID, $searchTerm, $postType, $queryString);

            $ret = $wpdb->get_results($sql, 'OBJECT');

            $ret = apply_filters('tc_cmb2_ajax_search_filter_result', $ret, $tcFieldID, $searchTerm, $postType, $queryString);


            if (!empty($ret)) {
                wp_send_json_success($ret);
            } else {
                wp_send_json_error($sql);
            }
        } else {
            wp_send_json_error($_POST);
        }

        wp_die();
    }

    public static function domain()
    {
        load_plugin_textdomain('tc_cmb2_ajax_search', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}
