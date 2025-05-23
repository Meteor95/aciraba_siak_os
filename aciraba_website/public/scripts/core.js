(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery")) : typeof define === "function" && define.amd ? define(["jquery"], factory) : (global = global || self, global.Util = factory(global.jQuery))
})(this, function($) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    var TRANSITION_END = "transitionend";
    var MAX_UID = 1e6;
    var MILLISECONDS_MULTIPLIER = 1e3;

    function toType(obj) {
        return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase()
    }

    function getSpecialTransitionEndEvent() {
        return {
            bindType: TRANSITION_END,
            delegateType: TRANSITION_END,
            handle: function handle(event) {
                if ($(event.target).is(this)) {
                    return event.handleObj.handler.apply(this, arguments)
                }
                return undefined
            }
        }
    }

    function transitionEndEmulator(duration) {
        var _this = this;
        var called = false;
        $(this).one(Util.TRANSITION_END, function() {
            called = true
        });
        setTimeout(function() {
            if (!called) {
                Util.triggerTransitionEnd(_this)
            }
        }, duration);
        return this
    }

    function setTransitionEndSupport() {
        $.fn.emulateTransitionEnd = transitionEndEmulator;
        $.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent()
    }
    var Util = {
        TRANSITION_END: "bsTransitionEnd",
        getUID: function getUID(prefix) {
            do {
                prefix += ~~(Math.random() * MAX_UID)
            } while (document.getElementById(prefix));
            return prefix
        },
        getSelectorFromElement: function getSelectorFromElement(element) {
            var selector = element.getAttribute("data-target");
            if (!selector || selector === "#") {
                var hrefAttr = element.getAttribute("href");
                selector = hrefAttr && hrefAttr !== "#" ? hrefAttr.trim() : ""
            }
            try {
                return document.querySelector(selector) ? selector : null
            } catch (err) {
                return null
            }
        },
        getTransitionDurationFromElement: function getTransitionDurationFromElement(element) {
            if (!element) {
                return 0
            }
            var transitionDuration = $(element).css("transition-duration");
            var transitionDelay = $(element).css("transition-delay");
            var floatTransitionDuration = parseFloat(transitionDuration);
            var floatTransitionDelay = parseFloat(transitionDelay);
            if (!floatTransitionDuration && !floatTransitionDelay) {
                return 0
            }
            transitionDuration = transitionDuration.split(",")[0];
            transitionDelay = transitionDelay.split(",")[0];
            return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER
        },
        reflow: function reflow(element) {
            return element.offsetHeight
        },
        triggerTransitionEnd: function triggerTransitionEnd(element) {
            $(element).trigger(TRANSITION_END)
        },
        supportsTransitionEnd: function supportsTransitionEnd() {
            return Boolean(TRANSITION_END)
        },
        isElement: function isElement(obj) {
            return (obj[0] || obj).nodeType
        },
        typeCheckConfig: function typeCheckConfig(componentName, config, configTypes) {
            for (var property in configTypes) {
                if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
                    var expectedTypes = configTypes[property];
                    var value = config[property];
                    var valueType = value && Util.isElement(value) ? "element" : toType(value);
                    if (!new RegExp(expectedTypes).test(valueType)) {
                        throw new Error(componentName.toUpperCase() + ": " + ('Option "' + property + '" provided type "' + valueType + '" ') + ('but expected type "' + expectedTypes + '".'))
                    }
                }
            }
        },
        findShadowRoot: function findShadowRoot(element) {
            if (!document.documentElement.attachShadow) {
                return null
            }
            if (typeof element.getRootNode === "function") {
                var root = element.getRootNode();
                return root instanceof ShadowRoot ? root : null
            }
            if (element instanceof ShadowRoot) {
                return element
            }
            if (!element.parentNode) {
                return null
            }
            return Util.findShadowRoot(element.parentNode)
        }
    };
    setTransitionEndSupport();
    return Util
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery")) : typeof define === "function" && define.amd ? define(["jquery"], factory) : (global = global || self, global.Button = factory(global.jQuery))
})(this, function($) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }
    var NAME = "button";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.button";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var ClassName = {
        ACTIVE: "active",
        BUTTON: "btn",
        FOCUS: "focus"
    };
    var Selector = {
        DATA_TOGGLE_CARROT: '[data-toggle^="button"]',
        DATA_TOGGLE: '[data-toggle="buttons"]',
        INPUT: 'input:not([type="hidden"])',
        ACTIVE: ".active",
        BUTTON: ".btn"
    };
    var Event = {
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY,
        FOCUS_BLUR_DATA_API: "focus" + EVENT_KEY + DATA_API_KEY + " " + ("blur" + EVENT_KEY + DATA_API_KEY)
    };
    var Button = function() {
        function Button(element) {
            this._element = element
        }
        var _proto = Button.prototype;
        _proto.toggle = function toggle() {
            var triggerChangeEvent = true;
            var addAriaPressed = true;
            var rootElement = $(this._element).closest(Selector.DATA_TOGGLE)[0];
            if (rootElement) {
                var input = this._element.querySelector(Selector.INPUT);
                if (input) {
                    if (input.type === "radio") {
                        if (input.checked && this._element.classList.contains(ClassName.ACTIVE)) {
                            triggerChangeEvent = false
                        } else {
                            var activeElement = rootElement.querySelector(Selector.ACTIVE);
                            if (activeElement) {
                                $(activeElement).removeClass(ClassName.ACTIVE)
                            }
                        }
                    }
                    if (triggerChangeEvent) {
                        if (input.hasAttribute("disabled") || rootElement.hasAttribute("disabled") || input.classList.contains("disabled") || rootElement.classList.contains("disabled")) {
                            return
                        }
                        input.checked = !this._element.classList.contains(ClassName.ACTIVE);
                        $(input).trigger("change")
                    }
                    input.focus();
                    addAriaPressed = false
                }
            }
            if (addAriaPressed) {
                this._element.setAttribute("aria-pressed", !this._element.classList.contains(ClassName.ACTIVE))
            }
            if (triggerChangeEvent) {
                $(this._element).toggleClass(ClassName.ACTIVE)
            }
        };
        _proto.dispose = function dispose() {
            $.removeData(this._element, DATA_KEY);
            this._element = null
        };
        Button._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var data = $(this).data(DATA_KEY);
                if (!data) {
                    data = new Button(this);
                    $(this).data(DATA_KEY, data)
                }
                if (config === "toggle") {
                    data[config]()
                }
            })
        };
        _createClass(Button, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }]);
        return Button
    }();
    $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE_CARROT, function(event) {
        event.preventDefault();
        var button = event.target;
        if (!$(button).hasClass(ClassName.BUTTON)) {
            button = $(button).closest(Selector.BUTTON)
        }
        Button._jQueryInterface.call($(button), "toggle")
    }).on(Event.FOCUS_BLUR_DATA_API, Selector.DATA_TOGGLE_CARROT, function(event) {
        var button = $(event.target).closest(Selector.BUTTON)[0];
        $(button).toggleClass(ClassName.FOCUS, /^focus(in)?$/.test(event.type))
    });
    $.fn[NAME] = Button._jQueryInterface;
    $.fn[NAME].Constructor = Button;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Button._jQueryInterface
    };
    return Button
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("popper.js"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "popper.js", "./util.js"], factory) : (global = global || self, global.Dropdown = factory(global.jQuery, global.Popper, global.Util))
})(this, function($, Popper, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Popper = Popper && Popper.hasOwnProperty("default") ? Popper["default"] : Popper;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            })
        } else {
            obj[key] = value
        }
        return obj
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);
            if (typeof Object.getOwnPropertySymbols === "function") {
                ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function(sym) {
                    return Object.getOwnPropertyDescriptor(source, sym).enumerable
                }))
            }
            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key])
            })
        }
        return target
    }
    var NAME = "dropdown";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.dropdown";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var ESCAPE_KEYCODE = 27;
    var SPACE_KEYCODE = 32;
    var TAB_KEYCODE = 9;
    var ARROW_UP_KEYCODE = 38;
    var ARROW_DOWN_KEYCODE = 40;
    var RIGHT_MOUSE_BUTTON_WHICH = 3;
    var REGEXP_KEYDOWN = new RegExp(ARROW_UP_KEYCODE + "|" + ARROW_DOWN_KEYCODE + "|" + ESCAPE_KEYCODE);
    var Event = {
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        CLICK: "click" + EVENT_KEY,
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY,
        KEYDOWN_DATA_API: "keydown" + EVENT_KEY + DATA_API_KEY,
        KEYUP_DATA_API: "keyup" + EVENT_KEY + DATA_API_KEY
    };
    var ClassName = {
        DISABLED: "disabled",
        SHOW: "show",
        DROPUP: "dropup",
        DROPRIGHT: "dropright",
        DROPLEFT: "dropleft",
        MENURIGHT: "dropdown-menu-right",
        MENULEFT: "dropdown-menu-left",
        POSITION_STATIC: "position-static"
    };
    var Selector = {
        DATA_TOGGLE: '[data-toggle="dropdown"]',
        FORM_CHILD: ".dropdown form",
        MENU: ".dropdown-menu",
        NAVBAR_NAV: ".navbar-nav",
        VISIBLE_ITEMS: ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)"
    };
    var AttachmentMap = {
        TOP: "top-start",
        TOPEND: "top-end",
        BOTTOM: "bottom-start",
        BOTTOMEND: "bottom-end",
        RIGHT: "right-start",
        RIGHTEND: "right-end",
        LEFT: "left-start",
        LEFTEND: "left-end"
    };
    var Default = {
        offset: 0,
        flip: true,
        boundary: "scrollParent",
        reference: "toggle",
        display: "dynamic"
    };
    var DefaultType = {
        offset: "(number|string|function)",
        flip: "boolean",
        boundary: "(string|element)",
        reference: "(string|element)",
        display: "string"
    };
    var Dropdown = function() {
        function Dropdown(element, config) {
            this._element = element;
            this._popper = null;
            this._config = this._getConfig(config);
            this._menu = this._getMenuElement();
            this._inNavbar = this._detectNavbar();
            this._addEventListeners()
        }
        var _proto = Dropdown.prototype;
        _proto.toggle = function toggle() {
            if (this._element.disabled || $(this._element).hasClass(ClassName.DISABLED)) {
                return
            }
            var parent = Dropdown._getParentFromElement(this._element);
            var isActive = $(this._menu).hasClass(ClassName.SHOW);
            Dropdown._clearMenus();
            if (isActive) {
                return
            }
            var relatedTarget = {
                relatedTarget: this._element
            };
            var showEvent = $.Event(Event.SHOW, relatedTarget);
            $(parent).trigger(showEvent);
            if (showEvent.isDefaultPrevented()) {
                return
            }
            if (!this._inNavbar) {
                if (typeof Popper === "undefined") {
                    throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)")
                }
                var referenceElement = this._element;
                if (this._config.reference === "parent") {
                    referenceElement = parent
                } else if (Util.isElement(this._config.reference)) {
                    referenceElement = this._config.reference;
                    if (typeof this._config.reference.jquery !== "undefined") {
                        referenceElement = this._config.reference[0]
                    }
                }
                if (this._config.boundary !== "scrollParent") {
                    $(parent).addClass(ClassName.POSITION_STATIC)
                }
                this._popper = new Popper(referenceElement, this._menu, this._getPopperConfig())
            }
            if ("ontouchstart" in document.documentElement && $(parent).closest(Selector.NAVBAR_NAV).length === 0) {
                $(document.body).children().on("mouseover", null, $.noop)
            }
            this._element.focus();
            this._element.setAttribute("aria-expanded", true);
            $(this._menu).toggleClass(ClassName.SHOW);
            $(parent).toggleClass(ClassName.SHOW).trigger($.Event(Event.SHOWN, relatedTarget))
        };
        _proto.show = function show() {
            if (this._element.disabled || $(this._element).hasClass(ClassName.DISABLED) || $(this._menu).hasClass(ClassName.SHOW)) {
                return
            }
            var relatedTarget = {
                relatedTarget: this._element
            };
            var showEvent = $.Event(Event.SHOW, relatedTarget);
            var parent = Dropdown._getParentFromElement(this._element);
            $(parent).trigger(showEvent);
            if (showEvent.isDefaultPrevented()) {
                return
            }
            $(this._menu).toggleClass(ClassName.SHOW);
            $(parent).toggleClass(ClassName.SHOW).trigger($.Event(Event.SHOWN, relatedTarget))
        };
        _proto.hide = function hide() {
            if (this._element.disabled || $(this._element).hasClass(ClassName.DISABLED) || !$(this._menu).hasClass(ClassName.SHOW)) {
                return
            }
            var relatedTarget = {
                relatedTarget: this._element
            };
            var hideEvent = $.Event(Event.HIDE, relatedTarget);
            var parent = Dropdown._getParentFromElement(this._element);
            $(parent).trigger(hideEvent);
            if (hideEvent.isDefaultPrevented()) {
                return
            }
            $(this._menu).toggleClass(ClassName.SHOW);
            $(parent).toggleClass(ClassName.SHOW).trigger($.Event(Event.HIDDEN, relatedTarget))
        };
        _proto.dispose = function dispose() {
            $.removeData(this._element, DATA_KEY);
            $(this._element).off(EVENT_KEY);
            this._element = null;
            this._menu = null;
            if (this._popper !== null) {
                this._popper.destroy();
                this._popper = null
            }
        };
        _proto.update = function update() {
            this._inNavbar = this._detectNavbar();
            if (this._popper !== null) {
                this._popper.scheduleUpdate()
            }
        };
        _proto._addEventListeners = function _addEventListeners() {
            var _this = this;
            $(this._element).on(Event.CLICK, function(event) {
                event.preventDefault();
                event.stopPropagation();
                _this.toggle()
            })
        };
        _proto._getConfig = function _getConfig(config) {
            config = _objectSpread({}, this.constructor.Default, $(this._element).data(), config);
            Util.typeCheckConfig(NAME, config, this.constructor.DefaultType);
            return config
        };
        _proto._getMenuElement = function _getMenuElement() {
            if (!this._menu) {
                var parent = Dropdown._getParentFromElement(this._element);
                if (parent) {
                    this._menu = parent.querySelector(Selector.MENU)
                }
            }
            return this._menu
        };
        _proto._getPlacement = function _getPlacement() {
            var $parentDropdown = $(this._element.parentNode);
            var placement = AttachmentMap.BOTTOM;
            if ($parentDropdown.hasClass(ClassName.DROPUP)) {
                placement = AttachmentMap.TOP;
                if ($(this._menu).hasClass(ClassName.MENURIGHT)) {
                    placement = AttachmentMap.TOPEND
                }
            } else if ($parentDropdown.hasClass(ClassName.DROPRIGHT)) {
                placement = AttachmentMap.RIGHT
            } else if ($parentDropdown.hasClass(ClassName.DROPLEFT)) {
                placement = AttachmentMap.LEFT
            } else if ($(this._menu).hasClass(ClassName.MENURIGHT)) {
                placement = AttachmentMap.BOTTOMEND
            }
            return placement
        };
        _proto._detectNavbar = function _detectNavbar() {
            return $(this._element).closest(".navbar").length > 0
        };
        _proto._getOffset = function _getOffset() {
            var _this2 = this;
            var offset = {};
            if (typeof this._config.offset === "function") {
                offset.fn = function(data) {
                    data.offsets = _objectSpread({}, data.offsets, _this2._config.offset(data.offsets, _this2._element) || {});
                    return data
                }
            } else {
                offset.offset = this._config.offset
            }
            return offset
        };
        _proto._getPopperConfig = function _getPopperConfig() {
            var popperConfig = {
                placement: this._getPlacement(),
                modifiers: {
                    offset: this._getOffset(),
                    flip: {
                        enabled: this._config.flip
                    },
                    preventOverflow: {
                        boundariesElement: this._config.boundary
                    }
                }
            };
            if (this._config.display === "static") {
                popperConfig.modifiers.applyStyle = {
                    enabled: false
                }
            }
            return popperConfig
        };
        Dropdown._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var data = $(this).data(DATA_KEY);
                var _config = typeof config === "object" ? config : null;
                if (!data) {
                    data = new Dropdown(this, _config);
                    $(this).data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config]()
                }
            })
        };
        Dropdown._clearMenus = function _clearMenus(event) {
            if (event && (event.which === RIGHT_MOUSE_BUTTON_WHICH || event.type === "keyup" && event.which !== TAB_KEYCODE)) {
                return
            }
            var toggles = [].slice.call(document.querySelectorAll(Selector.DATA_TOGGLE));
            for (var i = 0, len = toggles.length; i < len; i++) {
                var parent = Dropdown._getParentFromElement(toggles[i]);
                var context = $(toggles[i]).data(DATA_KEY);
                var relatedTarget = {
                    relatedTarget: toggles[i]
                };
                if (event && event.type === "click") {
                    relatedTarget.clickEvent = event
                }
                if (!context) {
                    continue
                }
                var dropdownMenu = context._menu;
                if (!$(parent).hasClass(ClassName.SHOW)) {
                    continue
                }
                if (event && (event.type === "click" && /input|textarea/i.test(event.target.tagName) || event.type === "keyup" && event.which === TAB_KEYCODE) && $.contains(parent, event.target)) {
                    continue
                }
                var hideEvent = $.Event(Event.HIDE, relatedTarget);
                $(parent).trigger(hideEvent);
                if (hideEvent.isDefaultPrevented()) {
                    continue
                }
                if ("ontouchstart" in document.documentElement) {
                    $(document.body).children().off("mouseover", null, $.noop)
                }
                toggles[i].setAttribute("aria-expanded", "false");
                $(dropdownMenu).removeClass(ClassName.SHOW);
                $(parent).removeClass(ClassName.SHOW).trigger($.Event(Event.HIDDEN, relatedTarget))
            }
        };
        Dropdown._getParentFromElement = function _getParentFromElement(element) {
            var parent;
            var selector = Util.getSelectorFromElement(element);
            if (selector) {
                parent = document.querySelector(selector)
            }
            return parent || element.parentNode
        };
        Dropdown._dataApiKeydownHandler = function _dataApiKeydownHandler(event) {
            if (/input|textarea/i.test(event.target.tagName) ? event.which === SPACE_KEYCODE || event.which !== ESCAPE_KEYCODE && (event.which !== ARROW_DOWN_KEYCODE && event.which !== ARROW_UP_KEYCODE || $(event.target).closest(Selector.MENU).length) : !REGEXP_KEYDOWN.test(event.which)) {
                return
            }
            event.preventDefault();
            event.stopPropagation();
            if (this.disabled || $(this).hasClass(ClassName.DISABLED)) {
                return
            }
            var parent = Dropdown._getParentFromElement(this);
            var isActive = $(parent).hasClass(ClassName.SHOW);
            if (!isActive || isActive && (event.which === ESCAPE_KEYCODE || event.which === SPACE_KEYCODE)) {
                if (event.which === ESCAPE_KEYCODE) {
                    var toggle = parent.querySelector(Selector.DATA_TOGGLE);
                    $(toggle).trigger("focus")
                }
                $(this).trigger("click");
                return
            }
            var items = [].slice.call(parent.querySelectorAll(Selector.VISIBLE_ITEMS));
            if (items.length === 0) {
                return
            }
            var index = items.indexOf(event.target);
            if (event.which === ARROW_UP_KEYCODE && index > 0) {
                index--
            }
            if (event.which === ARROW_DOWN_KEYCODE && index < items.length - 1) {
                index++
            }
            if (index < 0) {
                index = 0
            }
            items[index].focus()
        };
        _createClass(Dropdown, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }, {
            key: "Default",
            get: function get() {
                return Default
            }
        }, {
            key: "DefaultType",
            get: function get() {
                return DefaultType
            }
        }]);
        return Dropdown
    }();
    $(document).on(Event.KEYDOWN_DATA_API, Selector.DATA_TOGGLE, Dropdown._dataApiKeydownHandler).on(Event.KEYDOWN_DATA_API, Selector.MENU, Dropdown._dataApiKeydownHandler).on(Event.CLICK_DATA_API + " " + Event.KEYUP_DATA_API, Dropdown._clearMenus).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
        event.preventDefault();
        event.stopPropagation();
        Dropdown._jQueryInterface.call($(this), "toggle")
    }).on(Event.CLICK_DATA_API, Selector.FORM_CHILD, function(e) {
        e.stopPropagation()
    });
    $.fn[NAME] = Dropdown._jQueryInterface;
    $.fn[NAME].Constructor = Dropdown;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Dropdown._jQueryInterface
    };
    return Dropdown
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "./util.js"], factory) : (global = global || self, global.Alert = factory(global.jQuery, global.Util))
})(this, function($, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }
    var NAME = "alert";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.alert";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Selector = {
        DISMISS: '[data-dismiss="alert"]'
    };
    var Event = {
        CLOSE: "close" + EVENT_KEY,
        CLOSED: "closed" + EVENT_KEY,
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
    };
    var ClassName = {
        ALERT: "alert",
        FADE: "fade",
        SHOW: "show"
    };
    var Alert = function() {
        function Alert(element) {
            this._element = element
        }
        var _proto = Alert.prototype;
        _proto.close = function close(element) {
            var rootElement = this._element;
            if (element) {
                rootElement = this._getRootElement(element)
            }
            var customEvent = this._triggerCloseEvent(rootElement);
            if (customEvent.isDefaultPrevented()) {
                return
            }
            this._removeElement(rootElement)
        };
        _proto.dispose = function dispose() {
            $.removeData(this._element, DATA_KEY);
            this._element = null
        };
        _proto._getRootElement = function _getRootElement(element) {
            var selector = Util.getSelectorFromElement(element);
            var parent = false;
            if (selector) {
                parent = document.querySelector(selector)
            }
            if (!parent) {
                parent = $(element).closest("." + ClassName.ALERT)[0]
            }
            return parent
        };
        _proto._triggerCloseEvent = function _triggerCloseEvent(element) {
            var closeEvent = $.Event(Event.CLOSE);
            $(element).trigger(closeEvent);
            return closeEvent
        };
        _proto._removeElement = function _removeElement(element) {
            var _this = this;
            $(element).removeClass(ClassName.SHOW);
            if (!$(element).hasClass(ClassName.FADE)) {
                this._destroyElement(element);
                return
            }
            var transitionDuration = Util.getTransitionDurationFromElement(element);
            $(element).one(Util.TRANSITION_END, function(event) {
                return _this._destroyElement(element, event)
            }).emulateTransitionEnd(transitionDuration)
        };
        _proto._destroyElement = function _destroyElement(element) {
            $(element).detach().trigger(Event.CLOSED).remove()
        };
        Alert._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var $element = $(this);
                var data = $element.data(DATA_KEY);
                if (!data) {
                    data = new Alert(this);
                    $element.data(DATA_KEY, data)
                }
                if (config === "close") {
                    data[config](this)
                }
            })
        };
        Alert._handleDismiss = function _handleDismiss(alertInstance) {
            return function(event) {
                if (event) {
                    event.preventDefault()
                }
                alertInstance.close(this)
            }
        };
        _createClass(Alert, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }]);
        return Alert
    }();
    $(document).on(Event.CLICK_DATA_API, Selector.DISMISS, Alert._handleDismiss(new Alert));
    $.fn[NAME] = Alert._jQueryInterface;
    $.fn[NAME].Constructor = Alert;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Alert._jQueryInterface
    };
    return Alert
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "./util.js"], factory) : (global = global || self, global.Modal = factory(global.jQuery, global.Util))
})(this, function($, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            })
        } else {
            obj[key] = value
        }
        return obj
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);
            if (typeof Object.getOwnPropertySymbols === "function") {
                ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function(sym) {
                    return Object.getOwnPropertyDescriptor(source, sym).enumerable
                }))
            }
            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key])
            })
        }
        return target
    }
    var NAME = "modal";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.modal";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var ESCAPE_KEYCODE = 27;
    var Default = {
        backdrop: true,
        keyboard: true,
        focus: true,
        show: true
    };
    var DefaultType = {
        backdrop: "(boolean|string)",
        keyboard: "boolean",
        focus: "boolean",
        show: "boolean"
    };
    var Event = {
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        FOCUSIN: "focusin" + EVENT_KEY,
        RESIZE: "resize" + EVENT_KEY,
        CLICK_DISMISS: "click.dismiss" + EVENT_KEY,
        KEYDOWN_DISMISS: "keydown.dismiss" + EVENT_KEY,
        MOUSEUP_DISMISS: "mouseup.dismiss" + EVENT_KEY,
        MOUSEDOWN_DISMISS: "mousedown.dismiss" + EVENT_KEY,
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
    };
    var ClassName = {
        SCROLLABLE: "modal-dialog-scrollable",
        SCROLLBAR_MEASURER: "modal-scrollbar-measure",
        BACKDROP: "modal-backdrop",
        OPEN: "modal-open",
        FADE: "fade",
        SHOW: "show"
    };
    var Selector = {
        DIALOG: ".modal-dialog",
        MODAL_BODY: ".modal-body",
        DATA_TOGGLE: '[data-toggle="modal"]',
        DATA_DISMISS: '[data-dismiss="modal"]',
        FIXED_CONTENT: ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        STICKY_CONTENT: ".sticky-top"
    };
    var Modal = function() {
        function Modal(element, config) {
            this._config = this._getConfig(config);
            this._element = element;
            this._dialog = element.querySelector(Selector.DIALOG);
            this._backdrop = null;
            this._isShown = false;
            this._isBodyOverflowing = false;
            this._ignoreBackdropClick = false;
            this._isTransitioning = false;
            this._scrollbarWidth = 0
        }
        var _proto = Modal.prototype;
        _proto.toggle = function toggle(relatedTarget) {
            return this._isShown ? this.hide() : this.show(relatedTarget)
        };
        _proto.show = function show(relatedTarget) {
            var _this = this;
            if (this._isShown || this._isTransitioning) {
                return
            }
            if ($(this._element).hasClass(ClassName.FADE)) {
                this._isTransitioning = true
            }
            var showEvent = $.Event(Event.SHOW, {
                relatedTarget: relatedTarget
            });
            $(this._element).trigger(showEvent);
            if (this._isShown || showEvent.isDefaultPrevented()) {
                return
            }
            this._isShown = true;
            this._checkScrollbar();
            this._setScrollbar();
            this._adjustDialog();
            this._setEscapeEvent();
            this._setResizeEvent();
            $(this._element).on(Event.CLICK_DISMISS, Selector.DATA_DISMISS, function(event) {
                return _this.hide(event)
            });
            $(this._dialog).on(Event.MOUSEDOWN_DISMISS, function() {
                $(_this._element).one(Event.MOUSEUP_DISMISS, function(event) {
                    if ($(event.target).is(_this._element)) {
                        _this._ignoreBackdropClick = true
                    }
                })
            });
            this._showBackdrop(function() {
                return _this._showElement(relatedTarget)
            })
        };
        _proto.hide = function hide(event) {
            var _this2 = this;
            if (event) {
                event.preventDefault()
            }
            if (!this._isShown || this._isTransitioning) {
                return
            }
            var hideEvent = $.Event(Event.HIDE);
            $(this._element).trigger(hideEvent);
            if (!this._isShown || hideEvent.isDefaultPrevented()) {
                return
            }
            this._isShown = false;
            var transition = $(this._element).hasClass(ClassName.FADE);
            if (transition) {
                this._isTransitioning = true
            }
            this._setEscapeEvent();
            this._setResizeEvent();
            $(document).off(Event.FOCUSIN);
            $(this._element).removeClass(ClassName.SHOW);
            $(this._element).off(Event.CLICK_DISMISS);
            $(this._dialog).off(Event.MOUSEDOWN_DISMISS);
            if (transition) {
                var transitionDuration = Util.getTransitionDurationFromElement(this._element);
                $(this._element).one(Util.TRANSITION_END, function(event) {
                    return _this2._hideModal(event)
                }).emulateTransitionEnd(transitionDuration)
            } else {
                this._hideModal()
            }
        };
        _proto.dispose = function dispose() {
            [window, this._element, this._dialog].forEach(function(htmlElement) {
                return $(htmlElement).off(EVENT_KEY)
            });
            $(document).off(Event.FOCUSIN);
            $.removeData(this._element, DATA_KEY);
            this._config = null;
            this._element = null;
            this._dialog = null;
            this._backdrop = null;
            this._isShown = null;
            this._isBodyOverflowing = null;
            this._ignoreBackdropClick = null;
            this._isTransitioning = null;
            this._scrollbarWidth = null
        };
        _proto.handleUpdate = function handleUpdate() {
            this._adjustDialog()
        };
        _proto._getConfig = function _getConfig(config) {
            config = _objectSpread({}, Default, config);
            Util.typeCheckConfig(NAME, config, DefaultType);
            return config
        };
        _proto._showElement = function _showElement(relatedTarget) {
            var _this3 = this;
            var transition = $(this._element).hasClass(ClassName.FADE);
            if (!this._element.parentNode || this._element.parentNode.nodeType !== Node.ELEMENT_NODE) {
                document.body.appendChild(this._element)
            }
            this._element.style.display = "block";
            this._element.removeAttribute("aria-hidden");
            this._element.setAttribute("aria-modal", true);
            if ($(this._dialog).hasClass(ClassName.SCROLLABLE)) {
                this._dialog.querySelector(Selector.MODAL_BODY).scrollTop = 0
            } else {
                this._element.scrollTop = 0
            }
            if (transition) {
                Util.reflow(this._element)
            }
            $(this._element).addClass(ClassName.SHOW);
            if (this._config.focus) {
                this._enforceFocus()
            }
            var shownEvent = $.Event(Event.SHOWN, {
                relatedTarget: relatedTarget
            });
            var transitionComplete = function transitionComplete() {
                if (_this3._config.focus) {
                    _this3._element.focus()
                }
                _this3._isTransitioning = false;
                $(_this3._element).trigger(shownEvent)
            };
            if (transition) {
                var transitionDuration = Util.getTransitionDurationFromElement(this._dialog);
                $(this._dialog).one(Util.TRANSITION_END, transitionComplete).emulateTransitionEnd(transitionDuration)
            } else {
                transitionComplete()
            }
        };
        _proto._enforceFocus = function _enforceFocus() {
            var _this4 = this;
            $(document).off(Event.FOCUSIN).on(Event.FOCUSIN, function(event) {
                if (document !== event.target && _this4._element !== event.target && $(_this4._element).has(event.target).length === 0) {
                    _this4._element.focus()
                }
            })
        };
        _proto._setEscapeEvent = function _setEscapeEvent() {
            var _this5 = this;
            if (this._isShown && this._config.keyboard) {
                $(this._element).on(Event.KEYDOWN_DISMISS, function(event) {
                    if (event.which === ESCAPE_KEYCODE) {
                        event.preventDefault();
                        _this5.hide()
                    }
                })
            } else if (!this._isShown) {
                $(this._element).off(Event.KEYDOWN_DISMISS)
            }
        };
        _proto._setResizeEvent = function _setResizeEvent() {
            var _this6 = this;
            if (this._isShown) {
                $(window).on(Event.RESIZE, function(event) {
                    return _this6.handleUpdate(event)
                })
            } else {
                $(window).off(Event.RESIZE)
            }
        };
        _proto._hideModal = function _hideModal() {
            var _this7 = this;
            this._element.style.display = "none";
            this._element.setAttribute("aria-hidden", true);
            this._element.removeAttribute("aria-modal");
            this._isTransitioning = false;
            this._showBackdrop(function() {
                $(document.body).removeClass(ClassName.OPEN);
                _this7._resetAdjustments();
                _this7._resetScrollbar();
                $(_this7._element).trigger(Event.HIDDEN)
            })
        };
        _proto._removeBackdrop = function _removeBackdrop() {
            if (this._backdrop) {
                $(this._backdrop).remove();
                this._backdrop = null
            }
        };
        _proto._showBackdrop = function _showBackdrop(callback) {
            var _this8 = this;
            var animate = $(this._element).hasClass(ClassName.FADE) ? ClassName.FADE : "";
            if (this._isShown && this._config.backdrop) {
                this._backdrop = document.createElement("div");
                this._backdrop.className = ClassName.BACKDROP;
                if (animate) {
                    this._backdrop.classList.add(animate)
                }
                $(this._backdrop).appendTo(document.body);
                $(this._element).on(Event.CLICK_DISMISS, function(event) {
                    if (_this8._ignoreBackdropClick) {
                        _this8._ignoreBackdropClick = false;
                        return
                    }
                    if (event.target !== event.currentTarget) {
                        return
                    }
                    if (_this8._config.backdrop === "static") {
                        _this8._element.focus()
                    } else {
                        _this8.hide()
                    }
                });
                if (animate) {
                    Util.reflow(this._backdrop)
                }
                $(this._backdrop).addClass(ClassName.SHOW);
                if (!callback) {
                    return
                }
                if (!animate) {
                    callback();
                    return
                }
                var backdropTransitionDuration = Util.getTransitionDurationFromElement(this._backdrop);
                $(this._backdrop).one(Util.TRANSITION_END, callback).emulateTransitionEnd(backdropTransitionDuration)
            } else if (!this._isShown && this._backdrop) {
                $(this._backdrop).removeClass(ClassName.SHOW);
                var callbackRemove = function callbackRemove() {
                    _this8._removeBackdrop();
                    if (callback) {
                        callback()
                    }
                };
                if ($(this._element).hasClass(ClassName.FADE)) {
                    var _backdropTransitionDuration = Util.getTransitionDurationFromElement(this._backdrop);
                    $(this._backdrop).one(Util.TRANSITION_END, callbackRemove).emulateTransitionEnd(_backdropTransitionDuration)
                } else {
                    callbackRemove()
                }
            } else if (callback) {
                callback()
            }
        };
        _proto._adjustDialog = function _adjustDialog() {
            var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;
            if (!this._isBodyOverflowing && isModalOverflowing) {
                this._element.style.paddingLeft = this._scrollbarWidth + "px"
            }
            if (this._isBodyOverflowing && !isModalOverflowing) {
                this._element.style.paddingRight = this._scrollbarWidth + "px"
            }
        };
        _proto._resetAdjustments = function _resetAdjustments() {
            this._element.style.paddingLeft = "";
            this._element.style.paddingRight = ""
        };
        _proto._checkScrollbar = function _checkScrollbar() {
            var rect = document.body.getBoundingClientRect();
            this._isBodyOverflowing = rect.left + rect.right < window.innerWidth;
            this._scrollbarWidth = this._getScrollbarWidth()
        };
        _proto._setScrollbar = function _setScrollbar() {
            var _this9 = this;
            if (this._isBodyOverflowing) {
                var fixedContent = [].slice.call(document.querySelectorAll(Selector.FIXED_CONTENT));
                var stickyContent = [].slice.call(document.querySelectorAll(Selector.STICKY_CONTENT));
                $(fixedContent).each(function(index, element) {
                    var actualPadding = element.style.paddingRight;
                    var calculatedPadding = $(element).css("padding-right");
                    $(element).data("padding-right", actualPadding).css("padding-right", parseFloat(calculatedPadding) + _this9._scrollbarWidth + "px")
                });
                $(stickyContent).each(function(index, element) {
                    var actualMargin = element.style.marginRight;
                    var calculatedMargin = $(element).css("margin-right");
                    $(element).data("margin-right", actualMargin).css("margin-right", parseFloat(calculatedMargin) - _this9._scrollbarWidth + "px")
                })
            }
            $(document.body).addClass(ClassName.OPEN)
        };
        _proto._resetScrollbar = function _resetScrollbar() {
            var fixedContent = [].slice.call(document.querySelectorAll(Selector.FIXED_CONTENT));
            $(fixedContent).each(function(index, element) {
                var padding = $(element).data("padding-right");
                $(element).removeData("padding-right");
                element.style.paddingRight = padding ? padding : ""
            });
            var elements = [].slice.call(document.querySelectorAll("" + Selector.STICKY_CONTENT));
            $(elements).each(function(index, element) {
                var margin = $(element).data("margin-right");
                if (typeof margin !== "undefined") {
                    $(element).css("margin-right", margin).removeData("margin-right")
                }
            })
        };
        _proto._getScrollbarWidth = function _getScrollbarWidth() {
            var scrollDiv = document.createElement("div");
            scrollDiv.className = ClassName.SCROLLBAR_MEASURER;
            document.body.appendChild(scrollDiv);
            var scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
            document.body.removeChild(scrollDiv);
            return scrollbarWidth
        };
        Modal._jQueryInterface = function _jQueryInterface(config, relatedTarget) {
            return this.each(function() {
                var data = $(this).data(DATA_KEY);
                var _config = _objectSpread({}, Default, $(this).data(), typeof config === "object" && config ? config : {});
                if (!data) {
                    data = new Modal(this, _config);
                    $(this).data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config](relatedTarget)
                } else if (_config.show) {
                    data.show(relatedTarget)
                }
            })
        };
        _createClass(Modal, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }, {
            key: "Default",
            get: function get() {
                return Default
            }
        }]);
        return Modal
    }();
    $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
        var _this10 = this;
        var target;
        var selector = Util.getSelectorFromElement(this);
        if (selector) {
            target = document.querySelector(selector)
        }
        var config = $(target).data(DATA_KEY) ? "toggle" : _objectSpread({}, $(target).data(), $(this).data());
        if (this.tagName === "A" || this.tagName === "AREA") {
            event.preventDefault()
        }
        var $target = $(target).one(Event.SHOW, function(showEvent) {
            if (showEvent.isDefaultPrevented()) {
                return
            }
            $target.one(Event.HIDDEN, function() {
                if ($(_this10).is(":visible")) {
                    _this10.focus()
                }
            })
        });
        Modal._jQueryInterface.call($(target), config, this)
    });
    $.fn[NAME] = Modal._jQueryInterface;
    $.fn[NAME].Constructor = Modal;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Modal._jQueryInterface
    };
    return Modal
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "./util.js"], factory) : (global = global || self, global.Tab = factory(global.jQuery, global.Util))
})(this, function($, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }
    var NAME = "tab";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.tab";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Event = {
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
    };
    var ClassName = {
        DROPDOWN_MENU: "dropdown-menu",
        ACTIVE: "active",
        DISABLED: "disabled",
        FADE: "fade",
        SHOW: "show"
    };
    var Selector = {
        DROPDOWN: ".dropdown",
        NAV_LIST_GROUP: ".nav, .list-group",
        ACTIVE: ".active",
        ACTIVE_UL: "> li > .active",
        DATA_TOGGLE: '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
        DROPDOWN_TOGGLE: ".dropdown-toggle",
        DROPDOWN_ACTIVE_CHILD: "> .dropdown-menu .active"
    };
    var Tab = function() {
        function Tab(element) {
            this._element = element
        }
        var _proto = Tab.prototype;
        _proto.show = function show() {
            var _this = this;
            if (this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && $(this._element).hasClass(ClassName.ACTIVE) || $(this._element).hasClass(ClassName.DISABLED)) {
                return
            }
            var target;
            var previous;
            var listElement = $(this._element).closest(Selector.NAV_LIST_GROUP)[0];
            var selector = Util.getSelectorFromElement(this._element);
            if (listElement) {
                var itemSelector = listElement.nodeName === "UL" || listElement.nodeName === "OL" ? Selector.ACTIVE_UL : Selector.ACTIVE;
                previous = $.makeArray($(listElement).find(itemSelector));
                previous = previous[previous.length - 1]
            }
            var hideEvent = $.Event(Event.HIDE, {
                relatedTarget: this._element
            });
            var showEvent = $.Event(Event.SHOW, {
                relatedTarget: previous
            });
            if (previous) {
                $(previous).trigger(hideEvent)
            }
            $(this._element).trigger(showEvent);
            if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) {
                return
            }
            if (selector) {
                target = document.querySelector(selector)
            }
            this._activate(this._element, listElement);
            var complete = function complete() {
                var hiddenEvent = $.Event(Event.HIDDEN, {
                    relatedTarget: _this._element
                });
                var shownEvent = $.Event(Event.SHOWN, {
                    relatedTarget: previous
                });
                $(previous).trigger(hiddenEvent);
                $(_this._element).trigger(shownEvent)
            };
            if (target) {
                this._activate(target, target.parentNode, complete)
            } else {
                complete()
            }
        };
        _proto.dispose = function dispose() {
            $.removeData(this._element, DATA_KEY);
            this._element = null
        };
        _proto._activate = function _activate(element, container, callback) {
            var _this2 = this;
            var activeElements = container && (container.nodeName === "UL" || container.nodeName === "OL") ? $(container).find(Selector.ACTIVE_UL) : $(container).children(Selector.ACTIVE);
            var active = activeElements[0];
            var isTransitioning = callback && active && $(active).hasClass(ClassName.FADE);
            var complete = function complete() {
                return _this2._transitionComplete(element, active, callback)
            };
            if (active && isTransitioning) {
                var transitionDuration = Util.getTransitionDurationFromElement(active);
                $(active).removeClass(ClassName.SHOW).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration)
            } else {
                complete()
            }
        };
        _proto._transitionComplete = function _transitionComplete(element, active, callback) {
            if (active) {
                $(active).removeClass(ClassName.ACTIVE);
                var dropdownChild = $(active.parentNode).find(Selector.DROPDOWN_ACTIVE_CHILD)[0];
                if (dropdownChild) {
                    $(dropdownChild).removeClass(ClassName.ACTIVE)
                }
                if (active.getAttribute("role") === "tab") {
                    active.setAttribute("aria-selected", false)
                }
            }
            $(element).addClass(ClassName.ACTIVE);
            if (element.getAttribute("role") === "tab") {
                element.setAttribute("aria-selected", true)
            }
            Util.reflow(element);
            if (element.classList.contains(ClassName.FADE)) {
                element.classList.add(ClassName.SHOW)
            }
            if (element.parentNode && $(element.parentNode).hasClass(ClassName.DROPDOWN_MENU)) {
                var dropdownElement = $(element).closest(Selector.DROPDOWN)[0];
                if (dropdownElement) {
                    var dropdownToggleList = [].slice.call(dropdownElement.querySelectorAll(Selector.DROPDOWN_TOGGLE));
                    $(dropdownToggleList).addClass(ClassName.ACTIVE)
                }
                element.setAttribute("aria-expanded", true)
            }
            if (callback) {
                callback()
            }
        };
        Tab._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var $this = $(this);
                var data = $this.data(DATA_KEY);
                if (!data) {
                    data = new Tab(this);
                    $this.data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config]()
                }
            })
        };
        _createClass(Tab, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }]);
        return Tab
    }();
    $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
        event.preventDefault();
        Tab._jQueryInterface.call($(this), "show")
    });
    $.fn[NAME] = Tab._jQueryInterface;
    $.fn[NAME].Constructor = Tab;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Tab._jQueryInterface
    };
    return Tab
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("popper.js"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "popper.js", "./util.js"], factory) : (global = global || self, global.Tooltip = factory(global.jQuery, global.Popper, global.Util))
})(this, function($, Popper, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Popper = Popper && Popper.hasOwnProperty("default") ? Popper["default"] : Popper;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            })
        } else {
            obj[key] = value
        }
        return obj
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);
            if (typeof Object.getOwnPropertySymbols === "function") {
                ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function(sym) {
                    return Object.getOwnPropertyDescriptor(source, sym).enumerable
                }))
            }
            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key])
            })
        }
        return target
    }
    var uriAttrs = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"];
    var ARIA_ATTRIBUTE_PATTERN = /^aria-[\w-]*$/i;
    var DefaultWhitelist = {
        "*": ["class", "dir", "id", "lang", "role", ARIA_ATTRIBUTE_PATTERN],
        a: ["target", "href", "title", "rel"],
        area: [],
        b: [],
        br: [],
        col: [],
        code: [],
        div: [],
        em: [],
        hr: [],
        h1: [],
        h2: [],
        h3: [],
        h4: [],
        h5: [],
        h6: [],
        i: [],
        img: ["src", "alt", "title", "width", "height"],
        li: [],
        ol: [],
        p: [],
        pre: [],
        s: [],
        small: [],
        span: [],
        sub: [],
        sup: [],
        strong: [],
        u: [],
        ul: []
    };
    var SAFE_URL_PATTERN = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi;
    var DATA_URL_PATTERN = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;

    function allowedAttribute(attr, allowedAttributeList) {
        var attrName = attr.nodeName.toLowerCase();
        if (allowedAttributeList.indexOf(attrName) !== -1) {
            if (uriAttrs.indexOf(attrName) !== -1) {
                return Boolean(attr.nodeValue.match(SAFE_URL_PATTERN) || attr.nodeValue.match(DATA_URL_PATTERN))
            }
            return true
        }
        var regExp = allowedAttributeList.filter(function(attrRegex) {
            return attrRegex instanceof RegExp
        });
        for (var i = 0, l = regExp.length; i < l; i++) {
            if (attrName.match(regExp[i])) {
                return true
            }
        }
        return false
    }

    function sanitizeHtml(unsafeHtml, whiteList, sanitizeFn) {
        if (unsafeHtml.length === 0) {
            return unsafeHtml
        }
        if (sanitizeFn && typeof sanitizeFn === "function") {
            return sanitizeFn(unsafeHtml)
        }
        var domParser = new window.DOMParser;
        var createdDocument = domParser.parseFromString(unsafeHtml, "text/html");
        var whitelistKeys = Object.keys(whiteList);
        var elements = [].slice.call(createdDocument.body.querySelectorAll("*"));
        var _loop = function _loop(i, len) {
            var el = elements[i];
            var elName = el.nodeName.toLowerCase();
            if (whitelistKeys.indexOf(el.nodeName.toLowerCase()) === -1) {
                el.parentNode.removeChild(el);
                return "continue"
            }
            var attributeList = [].slice.call(el.attributes);
            var whitelistedAttributes = [].concat(whiteList["*"] || [], whiteList[elName] || []);
            attributeList.forEach(function(attr) {
                if (!allowedAttribute(attr, whitelistedAttributes)) {
                    el.removeAttribute(attr.nodeName)
                }
            })
        };
        for (var i = 0, len = elements.length; i < len; i++) {
            var _ret = _loop(i, len);
            if (_ret === "continue") continue
        }
        return createdDocument.body.innerHTML
    }
    var NAME = "tooltip";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.tooltip";
    var EVENT_KEY = "." + DATA_KEY;
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var CLASS_PREFIX = "bs-tooltip";
    var BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)" + CLASS_PREFIX + "\\S+", "g");
    var DISALLOWED_ATTRIBUTES = ["sanitize", "whiteList", "sanitizeFn"];
    var DefaultType = {
        animation: "boolean",
        template: "string",
        title: "(string|element|function)",
        trigger: "string",
        delay: "(number|object)",
        html: "boolean",
        selector: "(string|boolean)",
        placement: "(string|function)",
        offset: "(number|string|function)",
        container: "(string|element|boolean)",
        fallbackPlacement: "(string|array)",
        boundary: "(string|element)",
        sanitize: "boolean",
        sanitizeFn: "(null|function)",
        whiteList: "object"
    };
    var AttachmentMap = {
        AUTO: "auto",
        TOP: "top",
        RIGHT: "right",
        BOTTOM: "bottom",
        LEFT: "left"
    };
    var Default = {
        animation: true,
        template: '<div class="tooltip" role="tooltip">' + '<div class="arrow"></div>' + '<div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: false,
        selector: false,
        placement: "top",
        offset: 0,
        container: false,
        fallbackPlacement: "flip",
        boundary: "scrollParent",
        sanitize: true,
        sanitizeFn: null,
        whiteList: DefaultWhitelist
    };
    var HoverState = {
        SHOW: "show",
        OUT: "out"
    };
    var Event = {
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        INSERTED: "inserted" + EVENT_KEY,
        CLICK: "click" + EVENT_KEY,
        FOCUSIN: "focusin" + EVENT_KEY,
        FOCUSOUT: "focusout" + EVENT_KEY,
        MOUSEENTER: "mouseenter" + EVENT_KEY,
        MOUSELEAVE: "mouseleave" + EVENT_KEY
    };
    var ClassName = {
        FADE: "fade",
        SHOW: "show"
    };
    var Selector = {
        TOOLTIP: ".tooltip",
        TOOLTIP_INNER: ".tooltip-inner",
        ARROW: ".arrow"
    };
    var Trigger = {
        HOVER: "hover",
        FOCUS: "focus",
        CLICK: "click",
        MANUAL: "manual"
    };
    var Tooltip = function() {
        function Tooltip(element, config) {
            if (typeof Popper === "undefined") {
                throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)")
            }
            this._isEnabled = true;
            this._timeout = 0;
            this._hoverState = "";
            this._activeTrigger = {};
            this._popper = null;
            this.element = element;
            this.config = this._getConfig(config);
            this.tip = null;
            this._setListeners()
        }
        var _proto = Tooltip.prototype;
        _proto.enable = function enable() {
            this._isEnabled = true
        };
        _proto.disable = function disable() {
            this._isEnabled = false
        };
        _proto.toggleEnabled = function toggleEnabled() {
            this._isEnabled = !this._isEnabled
        };
        _proto.toggle = function toggle(event) {
            if (!this._isEnabled) {
                return
            }
            if (event) {
                var dataKey = this.constructor.DATA_KEY;
                var context = $(event.currentTarget).data(dataKey);
                if (!context) {
                    context = new this.constructor(event.currentTarget, this._getDelegateConfig());
                    $(event.currentTarget).data(dataKey, context)
                }
                context._activeTrigger.click = !context._activeTrigger.click;
                if (context._isWithActiveTrigger()) {
                    context._enter(null, context)
                } else {
                    context._leave(null, context)
                }
            } else {
                if ($(this.getTipElement()).hasClass(ClassName.SHOW)) {
                    this._leave(null, this);
                    return
                }
                this._enter(null, this)
            }
        };
        _proto.dispose = function dispose() {
            clearTimeout(this._timeout);
            $.removeData(this.element, this.constructor.DATA_KEY);
            $(this.element).off(this.constructor.EVENT_KEY);
            $(this.element).closest(".modal").off("hide.bs.modal");
            if (this.tip) {
                $(this.tip).remove()
            }
            this._isEnabled = null;
            this._timeout = null;
            this._hoverState = null;
            this._activeTrigger = null;
            if (this._popper !== null) {
                this._popper.destroy()
            }
            this._popper = null;
            this.element = null;
            this.config = null;
            this.tip = null
        };
        _proto.show = function show() {
            var _this = this;
            if ($(this.element).css("display") === "none") {
                throw new Error("Please use show on visible elements")
            }
            var showEvent = $.Event(this.constructor.Event.SHOW);
            if (this.isWithContent() && this._isEnabled) {
                $(this.element).trigger(showEvent);
                var shadowRoot = Util.findShadowRoot(this.element);
                var isInTheDom = $.contains(shadowRoot !== null ? shadowRoot : this.element.ownerDocument.documentElement, this.element);
                if (showEvent.isDefaultPrevented() || !isInTheDom) {
                    return
                }
                var tip = this.getTipElement();
                var tipId = Util.getUID(this.constructor.NAME);
                tip.setAttribute("id", tipId);
                this.element.setAttribute("aria-describedby", tipId);
                this.setContent();
                if (this.config.animation) {
                    $(tip).addClass(ClassName.FADE)
                }
                var placement = typeof this.config.placement === "function" ? this.config.placement.call(this, tip, this.element) : this.config.placement;
                var attachment = this._getAttachment(placement);
                this.addAttachmentClass(attachment);
                var container = this._getContainer();
                $(tip).data(this.constructor.DATA_KEY, this);
                if (!$.contains(this.element.ownerDocument.documentElement, this.tip)) {
                    $(tip).appendTo(container)
                }
                $(this.element).trigger(this.constructor.Event.INSERTED);
                this._popper = new Popper(this.element, tip, {
                    placement: attachment,
                    modifiers: {
                        offset: this._getOffset(),
                        flip: {
                            behavior: this.config.fallbackPlacement
                        },
                        arrow: {
                            element: Selector.ARROW
                        },
                        preventOverflow: {
                            boundariesElement: this.config.boundary
                        }
                    },
                    onCreate: function onCreate(data) {
                        if (data.originalPlacement !== data.placement) {
                            _this._handlePopperPlacementChange(data)
                        }
                    },
                    onUpdate: function onUpdate(data) {
                        return _this._handlePopperPlacementChange(data)
                    }
                });
                $(tip).addClass(ClassName.SHOW);
                if ("ontouchstart" in document.documentElement) {
                    $(document.body).children().on("mouseover", null, $.noop)
                }
                var complete = function complete() {
                    if (_this.config.animation) {
                        _this._fixTransition()
                    }
                    var prevHoverState = _this._hoverState;
                    _this._hoverState = null;
                    $(_this.element).trigger(_this.constructor.Event.SHOWN);
                    if (prevHoverState === HoverState.OUT) {
                        _this._leave(null, _this)
                    }
                };
                if ($(this.tip).hasClass(ClassName.FADE)) {
                    var transitionDuration = Util.getTransitionDurationFromElement(this.tip);
                    $(this.tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration)
                } else {
                    complete()
                }
            }
        };
        _proto.hide = function hide(callback) {
            var _this2 = this;
            var tip = this.getTipElement();
            var hideEvent = $.Event(this.constructor.Event.HIDE);
            var complete = function complete() {
                if (_this2._hoverState !== HoverState.SHOW && tip.parentNode) {
                    tip.parentNode.removeChild(tip)
                }
                _this2._cleanTipClass();
                _this2.element.removeAttribute("aria-describedby");
                $(_this2.element).trigger(_this2.constructor.Event.HIDDEN);
                if (_this2._popper !== null) {
                    _this2._popper.destroy()
                }
                if (callback) {
                    callback()
                }
            };
            $(this.element).trigger(hideEvent);
            if (hideEvent.isDefaultPrevented()) {
                return
            }
            $(tip).removeClass(ClassName.SHOW);
            if ("ontouchstart" in document.documentElement) {
                $(document.body).children().off("mouseover", null, $.noop)
            }
            this._activeTrigger[Trigger.CLICK] = false;
            this._activeTrigger[Trigger.FOCUS] = false;
            this._activeTrigger[Trigger.HOVER] = false;
            if ($(this.tip).hasClass(ClassName.FADE)) {
                var transitionDuration = Util.getTransitionDurationFromElement(tip);
                $(tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration)
            } else {
                complete()
            }
            this._hoverState = ""
        };
        _proto.update = function update() {
            if (this._popper !== null) {
                this._popper.scheduleUpdate()
            }
        };
        _proto.isWithContent = function isWithContent() {
            return Boolean(this.getTitle())
        };
        _proto.addAttachmentClass = function addAttachmentClass(attachment) {
            $(this.getTipElement()).addClass(CLASS_PREFIX + "-" + attachment)
        };
        _proto.getTipElement = function getTipElement() {
            this.tip = this.tip || $(this.config.template)[0];
            return this.tip
        };
        _proto.setContent = function setContent() {
            var tip = this.getTipElement();
            this.setElementContent($(tip.querySelectorAll(Selector.TOOLTIP_INNER)), this.getTitle());
            $(tip).removeClass(ClassName.FADE + " " + ClassName.SHOW)
        };
        _proto.setElementContent = function setElementContent($element, content) {
            if (typeof content === "object" && (content.nodeType || content.jquery)) {
                if (this.config.html) {
                    if (!$(content).parent().is($element)) {
                        $element.empty().append(content)
                    }
                } else {
                    $element.text($(content).text())
                }
                return
            }
            if (this.config.html) {
                if (this.config.sanitize) {
                    content = sanitizeHtml(content, this.config.whiteList, this.config.sanitizeFn)
                }
                $element.html(content)
            } else {
                $element.text(content)
            }
        };
        _proto.getTitle = function getTitle() {
            var title = this.element.getAttribute("data-original-title");
            if (!title) {
                title = typeof this.config.title === "function" ? this.config.title.call(this.element) : this.config.title
            }
            return title
        };
        _proto._getOffset = function _getOffset() {
            var _this3 = this;
            var offset = {};
            if (typeof this.config.offset === "function") {
                offset.fn = function(data) {
                    data.offsets = _objectSpread({}, data.offsets, _this3.config.offset(data.offsets, _this3.element) || {});
                    return data
                }
            } else {
                offset.offset = this.config.offset
            }
            return offset
        };
        _proto._getContainer = function _getContainer() {
            if (this.config.container === false) {
                return document.body
            }
            if (Util.isElement(this.config.container)) {
                return $(this.config.container)
            }
            return $(document).find(this.config.container)
        };
        _proto._getAttachment = function _getAttachment(placement) {
            return AttachmentMap[placement.toUpperCase()]
        };
        _proto._setListeners = function _setListeners() {
            var _this4 = this;
            var triggers = this.config.trigger.split(" ");
            triggers.forEach(function(trigger) {
                if (trigger === "click") {
                    $(_this4.element).on(_this4.constructor.Event.CLICK, _this4.config.selector, function(event) {
                        return _this4.toggle(event)
                    })
                } else if (trigger !== Trigger.MANUAL) {
                    var eventIn = trigger === Trigger.HOVER ? _this4.constructor.Event.MOUSEENTER : _this4.constructor.Event.FOCUSIN;
                    var eventOut = trigger === Trigger.HOVER ? _this4.constructor.Event.MOUSELEAVE : _this4.constructor.Event.FOCUSOUT;
                    $(_this4.element).on(eventIn, _this4.config.selector, function(event) {
                        return _this4._enter(event)
                    }).on(eventOut, _this4.config.selector, function(event) {
                        return _this4._leave(event)
                    })
                }
            });
            $(this.element).closest(".modal").on("hide.bs.modal", function() {
                if (_this4.element) {
                    _this4.hide()
                }
            });
            if (this.config.selector) {
                this.config = _objectSpread({}, this.config, {
                    trigger: "manual",
                    selector: ""
                })
            } else {
                this._fixTitle()
            }
        };
        _proto._fixTitle = function _fixTitle() {
            var titleType = typeof this.element.getAttribute("data-original-title");
            if (this.element.getAttribute("title") || titleType !== "string") {
                this.element.setAttribute("data-original-title", this.element.getAttribute("title") || "");
                this.element.setAttribute("title", "")
            }
        };
        _proto._enter = function _enter(event, context) {
            var dataKey = this.constructor.DATA_KEY;
            context = context || $(event.currentTarget).data(dataKey);
            if (!context) {
                context = new this.constructor(event.currentTarget, this._getDelegateConfig());
                $(event.currentTarget).data(dataKey, context)
            }
            if (event) {
                context._activeTrigger[event.type === "focusin" ? Trigger.FOCUS : Trigger.HOVER] = true
            }
            if ($(context.getTipElement()).hasClass(ClassName.SHOW) || context._hoverState === HoverState.SHOW) {
                context._hoverState = HoverState.SHOW;
                return
            }
            clearTimeout(context._timeout);
            context._hoverState = HoverState.SHOW;
            if (!context.config.delay || !context.config.delay.show) {
                context.show();
                return
            }
            context._timeout = setTimeout(function() {
                if (context._hoverState === HoverState.SHOW) {
                    context.show()
                }
            }, context.config.delay.show)
        };
        _proto._leave = function _leave(event, context) {
            var dataKey = this.constructor.DATA_KEY;
            context = context || $(event.currentTarget).data(dataKey);
            if (!context) {
                context = new this.constructor(event.currentTarget, this._getDelegateConfig());
                $(event.currentTarget).data(dataKey, context)
            }
            if (event) {
                context._activeTrigger[event.type === "focusout" ? Trigger.FOCUS : Trigger.HOVER] = false
            }
            if (context._isWithActiveTrigger()) {
                return
            }
            clearTimeout(context._timeout);
            context._hoverState = HoverState.OUT;
            if (!context.config.delay || !context.config.delay.hide) {
                context.hide();
                return
            }
            context._timeout = setTimeout(function() {
                if (context._hoverState === HoverState.OUT) {
                    context.hide()
                }
            }, context.config.delay.hide)
        };
        _proto._isWithActiveTrigger = function _isWithActiveTrigger() {
            for (var trigger in this._activeTrigger) {
                if (this._activeTrigger[trigger]) {
                    return true
                }
            }
            return false
        };
        _proto._getConfig = function _getConfig(config) {
            var dataAttributes = $(this.element).data();
            Object.keys(dataAttributes).forEach(function(dataAttr) {
                if (DISALLOWED_ATTRIBUTES.indexOf(dataAttr) !== -1) {
                    delete dataAttributes[dataAttr]
                }
            });
            config = _objectSpread({}, this.constructor.Default, dataAttributes, typeof config === "object" && config ? config : {});
            if (typeof config.delay === "number") {
                config.delay = {
                    show: config.delay,
                    hide: config.delay
                }
            }
            if (typeof config.title === "number") {
                config.title = config.title.toString()
            }
            if (typeof config.content === "number") {
                config.content = config.content.toString()
            }
            Util.typeCheckConfig(NAME, config, this.constructor.DefaultType);
            if (config.sanitize) {
                config.template = sanitizeHtml(config.template, config.whiteList, config.sanitizeFn)
            }
            return config
        };
        _proto._getDelegateConfig = function _getDelegateConfig() {
            var config = {};
            if (this.config) {
                for (var key in this.config) {
                    if (this.constructor.Default[key] !== this.config[key]) {
                        config[key] = this.config[key]
                    }
                }
            }
            return config
        };
        _proto._cleanTipClass = function _cleanTipClass() {
            var $tip = $(this.getTipElement());
            var tabClass = $tip.attr("class").match(BSCLS_PREFIX_REGEX);
            if (tabClass !== null && tabClass.length) {
                $tip.removeClass(tabClass.join(""))
            }
        };
        _proto._handlePopperPlacementChange = function _handlePopperPlacementChange(popperData) {
            var popperInstance = popperData.instance;
            this.tip = popperInstance.popper;
            this._cleanTipClass();
            this.addAttachmentClass(this._getAttachment(popperData.placement))
        };
        _proto._fixTransition = function _fixTransition() {
            var tip = this.getTipElement();
            var initConfigAnimation = this.config.animation;
            if (tip.getAttribute("x-placement") !== null) {
                return
            }
            $(tip).removeClass(ClassName.FADE);
            this.config.animation = false;
            this.hide();
            this.show();
            this.config.animation = initConfigAnimation
        };
        Tooltip._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var data = $(this).data(DATA_KEY);
                var _config = typeof config === "object" && config;
                if (!data && /dispose|hide/.test(config)) {
                    return
                }
                if (!data) {
                    data = new Tooltip(this, _config);
                    $(this).data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config]()
                }
            })
        };
        _createClass(Tooltip, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }, {
            key: "Default",
            get: function get() {
                return Default
            }
        }, {
            key: "NAME",
            get: function get() {
                return NAME
            }
        }, {
            key: "DATA_KEY",
            get: function get() {
                return DATA_KEY
            }
        }, {
            key: "Event",
            get: function get() {
                return Event
            }
        }, {
            key: "EVENT_KEY",
            get: function get() {
                return EVENT_KEY
            }
        }, {
            key: "DefaultType",
            get: function get() {
                return DefaultType
            }
        }]);
        return Tooltip
    }();
    $.fn[NAME] = Tooltip._jQueryInterface;
    $.fn[NAME].Constructor = Tooltip;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Tooltip._jQueryInterface
    };
    return Tooltip
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("./tooltip.js")) : typeof define === "function" && define.amd ? define(["jquery", "./tooltip.js"], factory) : (global = global || self, global.Popover = factory(global.jQuery, global.Tooltip))
})(this, function($, Tooltip) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Tooltip = Tooltip && Tooltip.hasOwnProperty("default") ? Tooltip["default"] : Tooltip;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            })
        } else {
            obj[key] = value
        }
        return obj
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);
            if (typeof Object.getOwnPropertySymbols === "function") {
                ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function(sym) {
                    return Object.getOwnPropertyDescriptor(source, sym).enumerable
                }))
            }
            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key])
            })
        }
        return target
    }

    function _inheritsLoose(subClass, superClass) {
        subClass.prototype = Object.create(superClass.prototype);
        subClass.prototype.constructor = subClass;
        subClass.__proto__ = superClass
    }
    var NAME = "popover";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.popover";
    var EVENT_KEY = "." + DATA_KEY;
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var CLASS_PREFIX = "bs-popover";
    var BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)" + CLASS_PREFIX + "\\S+", "g");
    var Default = _objectSpread({}, Tooltip.Default, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip">' + '<div class="arrow"></div>' + '<h3 class="popover-header"></h3>' + '<div class="popover-body"></div></div>'
    });
    var DefaultType = _objectSpread({}, Tooltip.DefaultType, {
        content: "(string|element|function)"
    });
    var ClassName = {
        FADE: "fade",
        SHOW: "show"
    };
    var Selector = {
        TITLE: ".popover-header",
        CONTENT: ".popover-body"
    };
    var Event = {
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        INSERTED: "inserted" + EVENT_KEY,
        CLICK: "click" + EVENT_KEY,
        FOCUSIN: "focusin" + EVENT_KEY,
        FOCUSOUT: "focusout" + EVENT_KEY,
        MOUSEENTER: "mouseenter" + EVENT_KEY,
        MOUSELEAVE: "mouseleave" + EVENT_KEY
    };
    var Popover = function(_Tooltip) {
        _inheritsLoose(Popover, _Tooltip);

        function Popover() {
            return _Tooltip.apply(this, arguments) || this
        }
        var _proto = Popover.prototype;
        _proto.isWithContent = function isWithContent() {
            return this.getTitle() || this._getContent()
        };
        _proto.addAttachmentClass = function addAttachmentClass(attachment) {
            $(this.getTipElement()).addClass(CLASS_PREFIX + "-" + attachment)
        };
        _proto.getTipElement = function getTipElement() {
            this.tip = this.tip || $(this.config.template)[0];
            return this.tip
        };
        _proto.setContent = function setContent() {
            var $tip = $(this.getTipElement());
            this.setElementContent($tip.find(Selector.TITLE), this.getTitle());
            var content = this._getContent();
            if (typeof content === "function") {
                content = content.call(this.element)
            }
            this.setElementContent($tip.find(Selector.CONTENT), content);
            $tip.removeClass(ClassName.FADE + " " + ClassName.SHOW)
        };
        _proto._getContent = function _getContent() {
            return this.element.getAttribute("data-content") || this.config.content
        };
        _proto._cleanTipClass = function _cleanTipClass() {
            var $tip = $(this.getTipElement());
            var tabClass = $tip.attr("class").match(BSCLS_PREFIX_REGEX);
            if (tabClass !== null && tabClass.length > 0) {
                $tip.removeClass(tabClass.join(""))
            }
        };
        Popover._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var data = $(this).data(DATA_KEY);
                var _config = typeof config === "object" ? config : null;
                if (!data && /dispose|hide/.test(config)) {
                    return
                }
                if (!data) {
                    data = new Popover(this, _config);
                    $(this).data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config]()
                }
            })
        };
        _createClass(Popover, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }, {
            key: "Default",
            get: function get() {
                return Default
            }
        }, {
            key: "NAME",
            get: function get() {
                return NAME
            }
        }, {
            key: "DATA_KEY",
            get: function get() {
                return DATA_KEY
            }
        }, {
            key: "Event",
            get: function get() {
                return Event
            }
        }, {
            key: "EVENT_KEY",
            get: function get() {
                return EVENT_KEY
            }
        }, {
            key: "DefaultType",
            get: function get() {
                return DefaultType
            }
        }]);
        return Popover
    }(Tooltip);
    $.fn[NAME] = Popover._jQueryInterface;
    $.fn[NAME].Constructor = Popover;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Popover._jQueryInterface
    };
    return Popover
});
(function(global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ? module.exports = factory(require("jquery"), require("./util.js")) : typeof define === "function" && define.amd ? define(["jquery", "./util.js"], factory) : (global = global || self, global.Collapse = factory(global.jQuery, global.Util))
})(this, function($, Util) {
    "use strict";
    $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
    Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            })
        } else {
            obj[key] = value
        }
        return obj
    }

    function _objectSpread(target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i] != null ? arguments[i] : {};
            var ownKeys = Object.keys(source);
            if (typeof Object.getOwnPropertySymbols === "function") {
                ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function(sym) {
                    return Object.getOwnPropertyDescriptor(source, sym).enumerable
                }))
            }
            ownKeys.forEach(function(key) {
                _defineProperty(target, key, source[key])
            })
        }
        return target
    }
    var NAME = "collapse";
    var VERSION = "4.3.1";
    var DATA_KEY = "bs.collapse";
    var EVENT_KEY = "." + DATA_KEY;
    var DATA_API_KEY = ".data-api";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Default = {
        toggle: true,
        parent: ""
    };
    var DefaultType = {
        toggle: "boolean",
        parent: "(string|element)"
    };
    var Event = {
        SHOW: "show" + EVENT_KEY,
        SHOWN: "shown" + EVENT_KEY,
        HIDE: "hide" + EVENT_KEY,
        HIDDEN: "hidden" + EVENT_KEY,
        CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
    };
    var ClassName = {
        SHOW: "show",
        COLLAPSE: "collapse",
        COLLAPSING: "collapsing",
        COLLAPSED: "collapsed"
    };
    var Dimension = {
        WIDTH: "width",
        HEIGHT: "height"
    };
    var Selector = {
        ACTIVES: ".show, .collapsing",
        DATA_TOGGLE: '[data-toggle="collapse"]'
    };
    var Collapse = function() {
        function Collapse(element, config) {
            this._isTransitioning = false;
            this._element = element;
            this._config = this._getConfig(config);
            this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + element.id + '"],' + ('[data-toggle="collapse"][data-target="#' + element.id + '"]')));
            var toggleList = [].slice.call(document.querySelectorAll(Selector.DATA_TOGGLE));
            for (var i = 0, len = toggleList.length; i < len; i++) {
                var elem = toggleList[i];
                var selector = Util.getSelectorFromElement(elem);
                var filterElement = [].slice.call(document.querySelectorAll(selector)).filter(function(foundElem) {
                    return foundElem === element
                });
                if (selector !== null && filterElement.length > 0) {
                    this._selector = selector;
                    this._triggerArray.push(elem)
                }
            }
            this._parent = this._config.parent ? this._getParent() : null;
            if (!this._config.parent) {
                this._addAriaAndCollapsedClass(this._element, this._triggerArray)
            }
            if (this._config.toggle) {
                this.toggle()
            }
        }
        var _proto = Collapse.prototype;
        _proto.toggle = function toggle() {
            if ($(this._element).hasClass(ClassName.SHOW)) {
                this.hide()
            } else {
                this.show()
            }
        };
        _proto.show = function show() {
            var _this = this;
            if (this._isTransitioning || $(this._element).hasClass(ClassName.SHOW)) {
                return
            }
            var actives;
            var activesData;
            if (this._parent) {
                actives = [].slice.call(this._parent.querySelectorAll(Selector.ACTIVES)).filter(function(elem) {
                    if (typeof _this._config.parent === "string") {
                        return elem.getAttribute("data-parent") === _this._config.parent
                    }
                    return elem.classList.contains(ClassName.COLLAPSE)
                });
                if (actives.length === 0) {
                    actives = null
                }
            }
            if (actives) {
                activesData = $(actives).not(this._selector).data(DATA_KEY);
                if (activesData && activesData._isTransitioning) {
                    return
                }
            }
            var startEvent = $.Event(Event.SHOW);
            $(this._element).trigger(startEvent);
            if (startEvent.isDefaultPrevented()) {
                return
            }
            if (actives) {
                Collapse._jQueryInterface.call($(actives).not(this._selector), "hide");
                if (!activesData) {
                    $(actives).data(DATA_KEY, null)
                }
            }
            var dimension = this._getDimension();
            $(this._element).removeClass(ClassName.COLLAPSE).addClass(ClassName.COLLAPSING);
            this._element.style[dimension] = 0;
            if (this._triggerArray.length) {
                $(this._triggerArray).removeClass(ClassName.COLLAPSED).attr("aria-expanded", true)
            }
            this.setTransitioning(true);
            var complete = function complete() {
                $(_this._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).addClass(ClassName.SHOW);
                _this._element.style[dimension] = "";
                _this.setTransitioning(false);
                $(_this._element).trigger(Event.SHOWN)
            };
            var capitalizedDimension = dimension[0].toUpperCase() + dimension.slice(1);
            var scrollSize = "scroll" + capitalizedDimension;
            var transitionDuration = Util.getTransitionDurationFromElement(this._element);
            $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration);
            this._element.style[dimension] = this._element[scrollSize] + "px"
        };
        _proto.hide = function hide() {
            var _this2 = this;
            if (this._isTransitioning || !$(this._element).hasClass(ClassName.SHOW)) {
                return
            }
            var startEvent = $.Event(Event.HIDE);
            $(this._element).trigger(startEvent);
            if (startEvent.isDefaultPrevented()) {
                return
            }
            var dimension = this._getDimension();
            this._element.style[dimension] = this._element.getBoundingClientRect()[dimension] + "px";
            Util.reflow(this._element);
            $(this._element).addClass(ClassName.COLLAPSING).removeClass(ClassName.COLLAPSE).removeClass(ClassName.SHOW);
            var triggerArrayLength = this._triggerArray.length;
            if (triggerArrayLength > 0) {
                for (var i = 0; i < triggerArrayLength; i++) {
                    var trigger = this._triggerArray[i];
                    var selector = Util.getSelectorFromElement(trigger);
                    if (selector !== null) {
                        var $elem = $([].slice.call(document.querySelectorAll(selector)));
                        if (!$elem.hasClass(ClassName.SHOW)) {
                            $(trigger).addClass(ClassName.COLLAPSED).attr("aria-expanded", false)
                        }
                    }
                }
            }
            this.setTransitioning(true);
            var complete = function complete() {
                _this2.setTransitioning(false);
                $(_this2._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).trigger(Event.HIDDEN)
            };
            this._element.style[dimension] = "";
            var transitionDuration = Util.getTransitionDurationFromElement(this._element);
            $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(transitionDuration)
        };
        _proto.setTransitioning = function setTransitioning(isTransitioning) {
            this._isTransitioning = isTransitioning
        };
        _proto.dispose = function dispose() {
            $.removeData(this._element, DATA_KEY);
            this._config = null;
            this._parent = null;
            this._element = null;
            this._triggerArray = null;
            this._isTransitioning = null
        };
        _proto._getConfig = function _getConfig(config) {
            config = _objectSpread({}, Default, config);
            config.toggle = Boolean(config.toggle);
            Util.typeCheckConfig(NAME, config, DefaultType);
            return config
        };
        _proto._getDimension = function _getDimension() {
            var hasWidth = $(this._element).hasClass(Dimension.WIDTH);
            return hasWidth ? Dimension.WIDTH : Dimension.HEIGHT
        };
        _proto._getParent = function _getParent() {
            var _this3 = this;
            var parent;
            if (Util.isElement(this._config.parent)) {
                parent = this._config.parent;
                if (typeof this._config.parent.jquery !== "undefined") {
                    parent = this._config.parent[0]
                }
            } else {
                parent = document.querySelector(this._config.parent)
            }
            var selector = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]';
            var children = [].slice.call(parent.querySelectorAll(selector));
            $(children).each(function(i, element) {
                _this3._addAriaAndCollapsedClass(Collapse._getTargetFromElement(element), [element])
            });
            return parent
        };
        _proto._addAriaAndCollapsedClass = function _addAriaAndCollapsedClass(element, triggerArray) {
            var isOpen = $(element).hasClass(ClassName.SHOW);
            if (triggerArray.length) {
                $(triggerArray).toggleClass(ClassName.COLLAPSED, !isOpen).attr("aria-expanded", isOpen)
            }
        };
        Collapse._getTargetFromElement = function _getTargetFromElement(element) {
            var selector = Util.getSelectorFromElement(element);
            return selector ? document.querySelector(selector) : null
        };
        Collapse._jQueryInterface = function _jQueryInterface(config) {
            return this.each(function() {
                var $this = $(this);
                var data = $this.data(DATA_KEY);
                var _config = _objectSpread({}, Default, $this.data(), typeof config === "object" && config ? config : {});
                if (!data && _config.toggle && /show|hide/.test(config)) {
                    _config.toggle = false
                }
                if (!data) {
                    data = new Collapse(this, _config);
                    $this.data(DATA_KEY, data)
                }
                if (typeof config === "string") {
                    if (typeof data[config] === "undefined") {
                        throw new TypeError('No method named "' + config + '"')
                    }
                    data[config]()
                }
            })
        };
        _createClass(Collapse, null, [{
            key: "VERSION",
            get: function get() {
                return VERSION
            }
        }, {
            key: "Default",
            get: function get() {
                return Default
            }
        }]);
        return Collapse
    }();
    $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
        if (event.currentTarget.tagName === "A") {
            event.preventDefault()
        }
        var $trigger = $(this);
        var selector = Util.getSelectorFromElement(this);
        var selectors = [].slice.call(document.querySelectorAll(selector));
        $(selectors).each(function() {
            var $target = $(this);
            var data = $target.data(DATA_KEY);
            var config = data ? "toggle" : $trigger.data();
            Collapse._jQueryInterface.call($target, config)
        })
    });
    $.fn[NAME] = Collapse._jQueryInterface;
    $.fn[NAME].Constructor = Collapse;
    $.fn[NAME].noConflict = function() {
        $.fn[NAME] = JQUERY_NO_CONFLICT;
        return Collapse._jQueryInterface
    };
    return Collapse
});
(function(factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory)
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"))
    } else {
        factory(jQuery)
    }
})(function($) {
    "use strict";
    $.fn.sidemenu = function(action) {
        var defaults = {
            element: {
                main: ".sidemenu",
                backdrop: "#sidemenu-backdrop",
                toggle: '[data-toggle="sidemenu"]',
                dismiss: '[data-dismiss="sidemenu"]'
            },
            class: {
                body: "sidemenu-open", active: "active"
            },
            data: {
                active: "sidemenu-active"
            },
            easing: "linear",
            transitionDuration: 200
        };
        var settings = $.extend({}, defaults, $.fn.sidemenu.defaults);
        var methods = [{
            event: "listener",
            action: function() {
                _listener();
            }
        }, {
            event: "show",
            action: function(target) {
                _show(target)
            }
        }, {
            event: "hide",
            action: function(target) {
                _hide(target)
            }
        }, {
            event: "toggle",
            action: function(target) {
                _toggle(target)
            }
        }];

        function _listener() {
            $(settings.element.toggle).on("click", function() {
                var target = $(this).data("target");
                _toggle($(target))
            });
            $(settings.element.dismiss).on("click", function() {
                _hide($(this.closest(settings.element.main)))
            })
        }

        function _toggle(target) {
            if ($("body").hasClass(settings.class.body) || target.data(settings.data.active)) {
                _hide(target)
            } else {
                _show(target)
            }
        }

        function _show(target) {
            if (target.hasClass(settings.element.main.substr(1))) {
                target.addClass(settings.class.active);
                $("body").addClass(settings.class.body);
                if ($(settings.element.backdrop).length < 1) {
                    var backdrop = '<div class="active" id="' + settings.element.backdrop.substr(1) + '"></div>';
                    $(backdrop).appendTo("body").animate({
                        opacity: 1
                    }, {
                        duration: settings.transitionDuration,
                        easing: settings.easing,
                        complete: function() {
                            $(this).on("click", function() {
                                _hide(target)
                            })
                        }
                    })
                }
                target.data(settings.data.active, true)
            }
        }

        function _hide(target) {
            if (target.hasClass(settings.element.main.substr(1))) {
                target.removeClass(settings.class.active);
                $("body").removeClass(settings.class.body);
                if ($(settings.element.backdrop).length > 0) {
                    $(settings.element.backdrop).animate({
                        opacity: 0
                    }, {
                        duration: settings.transitionDuration,
                        easing: settings.easing,
                        complete: function() {
                            $(this).remove()
                        }
                    }).off()
                }
                target.data(settings.data.active, false)
            }
        }
        var element = $(this);
        if (typeof action == "string") {
            methods.forEach(function(method) {
                if (action == method.event) {
                    method.action(element)
                }
            })
        }
        return this
    };
    $(function() {
        $().sidemenu("listener")
    })
});
(function(factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory)
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"))
    } else {
        factory(jQuery)
    }
})(function($) {
    "use strict";
    $.scrollToTop = function() {
        var defaults = {
            element: ".scrolltop",
            activeClass: "active",
            scrollHeight: 200,
            transitionDuration: 500
        };
        var settings = $.extend({}, defaults, $.scrollToTop.defaults);

        function _scroll() {
            $("html").animate({
                scrollTop: 0
            }, settings.transitionDuration)
        }

        function _hide() {
            $(settings.element).removeClass(settings.activeClass)
        }

        function _show() {
            $(settings.element).addClass(settings.activeClass)
        }
        if ($(window).scrollTop() >= settings.scrollHeight) {
            _show()
        }
        $(window).scroll(function() {
            $(this).scrollTop() >= settings.scrollHeight ? _show() : _hide()
        });
        $(settings.element).on("click", function() {
            _scroll()
        })
    };
    $(function() {
        $.scrollToTop()
    })
});
(function(factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory)
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"))
    } else {
        factory(jQuery)
    }
})(function($) {
    "use strict";
    $.fn.portlet = function(action) {
        var defaults = {
            element: {
                main: ".portlet",
                body: ".portlet-body"
            },
            data: {
                hidden: "portlet-hidden"
            },
            collapsedClass: "portlet-collapsed",
            destroyMethod: "fade",
            easing: "linear",
            transitionDuration: 200
        };
        var settings = $.extend({}, defaults, $.fn.portlet.defaults);
        var methods = [{
            event: "collapse",
            action: function(target) {
                _collapse(target)
            }
        }, {
            event: "uncollapse",
            action: function(target) {
                _uncollapse(target)
            }
        }, {
            event: "toggleCollapse",
            action: function(target) {
                _toggleCollapse(target)
            }
        }, {
            event: "destroy",
            action: function(target) {
                _destroy(target)
            }
        }];

        function _destroy(target) {
            if (target.hasClass(settings.element.main.substr(1))) {
                var type = settings.destroyMethod;
                if (type === "fade") {
                    target.fadeOut(settings.transitionDuration)
                } else if (type === "slide") {
                    target.slideUp(settings.transitionDuration)
                } else {
                    target.fadeOut(settings.transitionDuration)
                }
            }
        }

        function _collapse(target) {
            if (target.hasClass(settings.element.main.substr(1))) {
                target.find(settings.element.body).slideUp({
                    duration: settings.transitionDuration,
                    easing: settings.easing,
                    complete: function() {
                        target.data(settings.data.hidden, true);
                        target.addClass(settings.collapsedClass)
                    }
                })
            }
        }

        function _uncollapse(target) {
            if (target.hasClass(settings.element.main.substr(1))) {
                target.find(settings.element.body).slideDown({
                    duration: settings.transitionDuration,
                    easing: settings.easing,
                    complete: function() {
                        target.data(settings.data.hidden, false)
                    }
                }).removeClass(settings.collapsedClass)
            }
        }

        function _toggleCollapse(target) {
            target.data(settings.data.hidden) ? _uncollapse(target) : _collapse(target)
        }
        var element = $(this);
        if (typeof action == "string") {
            methods.forEach(function(method) {
                if (action == method.event) {
                    method.action(element)
                }
            })
        }
        return this
    };
    $(function() {
        $(".portlet.portlet-collapsed").portlet("collapse");
        $('[data-toggle="portlet"]').on("click", function() {
            var target = $(this).data("target");
            var behavior = $(this).data("behavior");
            target = target === "parent" ? $(this).closest(".portlet") : $(target);
            target.portlet(behavior)
        })
    })
});
(function(factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory)
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"))
    } else {
        factory(jQuery)
    }
})(function($) {
    "use strict";
    $.fn.menu = function(action) {
        var defaults = {
            element: {
                main: ".menu-item",
                toggle: ".menu-item-toggle",
                link: ".menu-item-link",
                menu: ".menu-submenu"
            },
            data: {
                activated: "menu-activated",
                numParent: "menu-num-parent",
                height: "menu-height",
                path: "menu-path"
            },
            activeClass: "active"
        };
        var settings = $.extend({}, defaults, $.fn.menu.defaults);
        var methods = [{
            event: "init",
            action: function() {
                _init();
                _listener()
            }
        }, {
            event: "show",
            action: function(target) {
                _show(target)
            }
        }, {
            event: "hide",
            action: function(target) {
                _hide(target)
            }
        }];

        function _calc(target) {
            var height = target.outerHeight();
            target.data(settings.data.height, height)
        }

        function _init() {
            var hasMinimized = $("body").hasClass("aside-minimized");
            var currentPath = window.location.pathname;
            var maxParent = 0;
            if (hasMinimized) {
                $("body").removeClass("aside-minimized")
            }
            $(settings.element.main).each(function() {
                var numParent = $(this).parents(settings.element.menu).length;
                if (numParent > maxParent) {
                    maxParent = numParent
                }
                $(this).data(settings.data.numParent, numParent)
            });
            $(settings.element.link).each(function() {
                if ($(this).data(settings.data.path) == currentPath) {
                    $(this).addClass(settings.activeClass);
                    $(this).parents(settings.element.main).each(function() {
                        var menu = $(this).children(settings.element.menu);
                        if (menu.length) {
                            _show(menu)
                        }
                    })
                }
            });
            for (var i = maxParent; i >= 0; i--) {
                $(settings.element.main).each(function() {
                    var numParent = $(this).data(settings.data.numParent);
                    var menu = $(this).children(settings.element.menu);
                    if (numParent == i) {
                        $(this).data(settings.data.activated, true);
                        if (menu.length != 0) {
                            _calc(menu);
                            if ($(this).children(settings.element.toggle).hasClass(settings.activeClass)) {
                                _show(menu)
                            } else {
                                _hide(menu)
                            }
                        }
                    }
                })
            }
            if (hasMinimized) {
                $("body").addClass("aside-minimized")
            }
        }

        function _listener() {
            $(settings.element.toggle).on("click", function() {
                var target = $(this).siblings(settings.element.menu);
                var activated = target.data(settings.data.activated);
                activated ? _hide(target) : _show(target)
            })
        }

        function _show(target) {
            target = target.first();
            if (target.hasClass(settings.element.menu.substr(1))) {
                var height = target.data(settings.data.height);
                var numParent = target.parent(settings.element.main).data(settings.data.numParent);
                target.css("height", height);
                target.parents(settings.element.menu).each(function() {
                    var parentHeight = $(this).data(settings.data.height) + height;
                    $(this).css("height", parentHeight);
                    $(this).data(settings.data.height, parentHeight)
                });
                target.siblings(settings.element.toggle).addClass(settings.activeClass);
                target.data(settings.data.activated, true)
            }
        }

        function _hide(target) {
            target = target.first();
            if (target.hasClass(settings.element.menu.substr(1))) {
                var height = target.data(settings.data.height);
                target.css("height", 0);
                target.parents(settings.element.menu).each(function() {
                    var parentHeight = $(this).data(settings.data.height) - height;
                    $(this).data(settings.data.height, parentHeight);
                    $(this).css("height", parentHeight)
                });
                target.siblings(settings.element.toggle).removeClass(settings.activeClass);
                target.data(settings.data.activated, false)
            }
        }
        var element = $(this);
        if (typeof action == "string") {
            methods.forEach(function(method) {
                if (action == method.event) {
                    method.action(element)
                }
            })
        }
        return this
    };
    $(function() {
        $().menu("init")
    })
});
(function(factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory)
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"))
    } else {
        factory(jQuery)
    }
})(function($) {
    "use strict";
    $.preload = function(action) {
        var defaults = {
            bodyHideClass: "preload-hide",
            bodyActiveClass: "preload-active"
        };
        var settings = $.extend({}, defaults, $.preload.defaults);
        var methods = [{
            event: "show",
            action: function() {
                _show()
            }
        }, {
            event: "hide",
            action: function() {
                _hide()
            }
        }];

        function _show() {
            $("body").removeClass(settings.bodyHideClass);
            $("body").addClass(settings.bodyActiveClass)
        }

        function _hide() {
            $("body").addClass(settings.bodyHideClass);
            $("body").removeClass(settings.bodyActiveClass)
        }
        var element = $(this);
        if (typeof action == "string") {
            methods.forEach(function(method) {
                if (action == method.event) {
                    method.action(element)
                }
            })
        }
        return this
    };
    setTimeout(function() {
        $.preload("hide")
    }, 6e3);
    $(function() {
        $.preload("hide")
    })
});
var toolbarOptions = 
[
    ['bold', 'italic', 'underline', 'strike'],       
    ['blockquote', 'code-block'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],     
    [{ 'indent': '-1'}, { 'indent': '+1' }],         
    [{ 'direction': 'rtl' }],                        
    ['clean']
];
//# sourceMappingURL=core.js.map