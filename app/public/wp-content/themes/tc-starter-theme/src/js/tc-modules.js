//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//ANIMATIONS
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
export function tcFadeIn(element) {
    var op = 0.1;  // initial opacity
    var timer = setInterval(function () {
        if (op >= 1) {
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);
}


export function tcFadeOut(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.01) {
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 10);
}

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//PERFORMANCES
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

export function tcAppendStyleSheet(url, id) {
    let linkTag = document.createElement('link');
    linkTag.setAttribute('rel', 'stylesheet')
    linkTag.setAttribute('type', 'text/css')
    linkTag.setAttribute('href', url)
    linkTag.setAttribute('id', id)
    document.head.appendChild(linkTag)
}

export function tcGetScript(source, callback, async = 1) {
    var script = document.createElement('script');
    var prior = document.getElementsByTagName('script')[0];
    script.async = async;


    script.onload = script.onreadystatechange = (_, isAbort) => {
        if (isAbort || !script.readyState || /loaded|complete/.test(script.readyState)) {
            script.onload = script.onreadystatechange = null;
            script = undefined;

            if (!isAbort) if (callback) callback();
        }
    };

    script.src = source;
    prior.parentNode.insertBefore(script, prior);
};

function tcYieldToMainThread(timeout) {
    return new Promise(resolve => {
        setTimeout(resolve, timeout);
    });
}

export async function tcLoader(tasks, timeout = 200) {
    while (tasks.length > 0) {
        const task = tasks.shift();
        task();
        await tcYieldToMainThread(timeout);
    }
}



//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// SCROLLING
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------


export function tcThrottle(fn, wait) {
    let time = Date.now();
    return function () {
        if ((time + wait - Date.now()) < 0) {
            fn();
            time = Date.now();
        }
    }
};

export function tcParallax(element, offSetTop, speed) {

    let scrolled = window.pageYOffset - offSetTop;
    let coords = (scrolled * speed) + 'px'
    element.style.transform = 'translateY(' + coords + ')';


};

export function tcIsInViewport(el, offset = 0) {
    let rect = el.getBoundingClientRect();
    let elemTop = rect.top;
    let elemBottom = rect.bottom;

    return elemTop < (window.innerHeight + offset) && elemBottom >= 0;
}


export function tcDetectScrollDirection() {
    window.addEventListener('wheel', function (event) {
        if (event.deltaY < 0) {
            return 'up';

        } else if (event.deltaY > 0) {
            return 'down';
        }
    });
}

export function tcScrollTo(top = 0, left = 0) {
    window.scroll({top: top, left: left, behavior: 'smooth'});
}


//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// NETWORKING
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
export function tcSerializeForm(form) {
    let obj = {};
    let formData = new FormData(form);
    for (let key of formData.keys()) {
        obj[key] = formData.get(key);
    }
    return obj;
};

export async function tcFetchData(method, inputUrl, parameters = {}, headers, cached = false) {

    let body = null;
    if (method === 'GET') {
        inputUrl = tcGetUrlWithParams(inputUrl, parameters)
    } else if (method === 'POST') {
        body = JSON.stringify(parameters);
    }
    if (cached === false) {
        inputUrl = tcGetUrlWithParams(inputUrl, {time: new Date().getTime()})
    }
    try {
        const response = await fetch(
            inputUrl,
            {
                method: method,
                headers: {
                    'Cache-Control': 'no-cache',
                    'Content-Type': 'application/json',
                    ...headers
                },
                body: body,
            },
        );

        return await response.json();
    } catch (error) {

        throw error;
    }
}

function tcGetUrlWithParams(baseUrl, parameters) {
    const retUrl = new URL(baseUrl);
    Object.keys(parameters).forEach((key) => {
        retUrl.searchParams.append(key, parameters[key])
    });
    return retUrl.href;
}

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// FORMAT STRING
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
export function tcHtmlDecode(input) {
    var doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}

export function tcCapitalizeFirstLetter(input) {
    let lowerCased = input.toLowerCase();
    return lowerCased.charAt(0).toUpperCase() + lowerCased.slice(1);
}
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// COOKIES
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

export function tcGetCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

export function tcSetCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// UTILITIES
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
export function tcShuffleElements(elems) {

    let allElems = (function () {
        var ret = [], l = elems.length;
        while (l--) {
            ret[ret.length] = elems[l];
        }
        return ret;
    })();

    var shuffled = (function () {
        var l = allElems.length, ret = [];
        while (l--) {
            var random = Math.floor(Math.random() * allElems.length),
                randEl = allElems[random].cloneNode(true);
            allElems.splice(random, 1);
            ret[ret.length] = randEl;
        }
        return ret;
    })(), l = elems.length;

    while (l--) {
        elems[l].parentNode.insertBefore(shuffled[l], elems[l].nextSibling);
        elems[l].parentNode.removeChild(elems[l]);
    }

}

export function tcDetectBrowser() {
    let ua = navigator.userAgent;
    let tem;
    let M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE ' + (tem[1] || '');
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
        if (tem != null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null) M.splice(1, 1, tem[1]);
    return M;
}


export function tcBrowserCanSupportWebP__js() {
    var elem = document.createElement('canvas');
    if (!!(elem.getContext && elem.getContext('2d'))) {
        return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
    }
    return false;
}



export function tcAppendTo(oldParent, newParent) {
    while (oldParent.childNodes.length > 0) {
        newParent.appendChild(oldParent.childNodes[0]);
    }
}

export function tcElementToArray(selector, attributeName) {
    let retArray = [];
    document.querySelectorAll(selector).forEach((item) => {
        let attribute = item.getAttribute(attributeName)
        retArray.push(attribute)
    })

    return retArray;
}
