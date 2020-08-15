! function(e, o) {
    "use strict";
    var n = {
        init: function() {
            o.hooks.addAction("frontend/element_ready/section", n.elementorSection)
        },
        elementorSection: function(e) {
            var n = e;
            Boolean(o.isEditMode());
            new ParallaxPluginSections(n).init()
        }
    };
    e(window).on("elementor/frontend/init", n.init), window.ParallaxPluginSections = function(n) {
        var a = this,
            t = n.data("id"),
            i = !1,
            l = Boolean(o.isEditMode()),
            r = e(window),
            s = (e("body"), []),
            d = [],
            c = r.scrollTop(),
            u = r.height(),
            _ = 0,
            p = 0,
            m = (navigator.userAgent.match(/Version\/[\d\.]+.*Safari/), navigator.platform);
        a.init = function() {
            if (!(i = l ? a.generateEditorSettings(t) : parallaxSection.ParallaxPluginSections[t] || !1)) return !1;
            n.addClass("parallax-section"), a.generateLayouts(), r.on("scroll.ParallaxPluginSections resize.ParallaxPluginSections", a.scrollHandler), n.on("mousemove.ParallaxPluginSections", a.mouseMoveHandler), n.on("mouseleave.ParallaxPluginSections", a.mouseLeaveHandler), a.scrollUpdate()
        }, a.generateEditorSettings = function(o) {
            var n, a, t = {},
                i = [];
            return !!window.elementor.hasOwnProperty("elements") && (!!(n = window.elementor.elements).models && (e.each(n.models, function(e, n) {
                o == n.id && (t = n.attributes.settings.attributes)
            }), !(!t.hasOwnProperty("parallax_addons_plugin_layout_list") || 0 === Object.keys(t).length) && (a = t.parallax_addons_plugin_layout_list.models, e.each(a, function(e, o) {
                i.push(o.attributes)
            }), 0 !== i.length && i)))
        }, a.generateLayouts = function() {
            e(".parallax-addons-parallax-plugin-section__layout", n).remove(), e.each(i, function(o, a) {
                var t, i, l = a.parallax_addons_plugin_layout_image,
                    r = a.parallax_addons_plugin_layout_speed.size || 50,
                    c = a.parallax_addons_plugin_layout_z_index,
                    u = a.parallax_addons_plugin_layout_bg_size || "auto",
                    _ = a.parallax_addons_plugin_layout_animation_prop || "bgposition",
                    p = a.parallax_addons_plugin_layout_bg_x,
                    g = a.parallax_addons_plugin_layout_bg_y,
                    x = a.parallax_addons_plugin_layout_type || "none",
                    y = a._id,
                    f = a.hasOwnProperty("__dynamic__") && a.__dynamic__.hasOwnProperty("parallax_addons_plugin_layout_image"),
                    h = "MacIntel" == m ? " is-mac" : "";
                if ("" === l.url && !f) return !1;
                t = e('<div class="parallax-addons-parallax-section__layout parallax-repeater-item-' + y + " parallax-addons-parallax__" + x + "-layout" + h + '"><div class="parallax-addons-parallax-section__image"></div></div>').prependTo(n).css({
                    "z-index": c
                });
                var P = {
                    "background-size": u,
                    "background-position-x": p + "%",
                    "background-position-y": g + "%"
                };
                "" !== l.url && (P["background-image"] = "url(" + l.url + ")"), e("> .parallax-addons-parallax-section__image", t).css(P), i = {
                    selector: t,
                    image: l.url,
                    size: u,
                    prop: _,
                    type: x,
                    xPos: p,
                    yPos: g,
                    zIndex: c,
                    speed: r / 100 * 2
                }, "scroll" === x && s.push(i), "mouse" === x && d.push(i)
            })
        }, a.scrollHandler = function(e) {
            c = r.scrollTop(), u = r.height(), a.scrollUpdate()
        }, a.scrollUpdate = function() {
            e.each(s, function(o, n) {
                var a = n.selector,
                    t = e(".parallax-addons-parallax-section__image", a),
                    i = n.speed,
                    l = a.offset().top,
                    r = a.outerHeight(),
                    s = (n.prop, (c - l + u) / r * 100);
                c < l - u && (s = 0), c > l + r && (s = 200), s = parseFloat(i * s).toFixed(1), "bgposition" === n.prop ? t.css({
                    "background-position-y": "calc(" + n.yPos + "% + " + s + "px)"
                }) : t.css({
                    transform: "translateY(" + s + "px)"
                })
            })
        }, a.mouseMoveHandler = function(e) {
            var o = r.width(),
                n = r.height(),
                t = Math.ceil(o / 2),
                i = Math.ceil(n / 2),
                l = e.clientX - t,
                s = e.clientY - i;
            _ = l / t * -1, p = s / i * -1, a.mouseMoveUpdate()
        }, a.mouseLeaveHandler = function(o) {
            e.each(d, function(o, n) {
                var a = n.selector,
                    t = e(".parallax-addons-parallax-section__image", a);
                switch (n.prop) {
                    case "transform3d":
                        TweenMax.to(t[0], 1.5, {
                            x: 0,
                            y: 0,
                            z: 0,
                            rotationX: 0,
                            rotationY: 0,
                            ease: Power2.easeOut
                        })
                }
            })
        }, a.mouseMoveUpdate = function() {
            e.each(d, function(o, n) {
                var a = n.selector,
                    t = e(".parallax-addons-parallax-section__image", a),
                    i = n.speed,
                    l = n.prop,
                    r = parseFloat(125 * _ * i).toFixed(1),
                    s = parseFloat(125 * p * i).toFixed(1),
                    d = 50 * n.zIndex,
                    c = parseFloat(25 * _ * i).toFixed(1),
                    u = parseFloat(25 * p * i).toFixed(1);
                switch (l) {
                    case "bgposition":
                        TweenMax.to(t[0], 1, {
                            backgroundPositionX: "calc(" + n.xPos + "% + " + r + "px)",
                            backgroundPositionY: "calc(" + n.yPos + "% + " + s + "px)",
                            ease: Power2.easeOut
                        });
                        break;
                    case "transform":
                        TweenMax.to(t[0], 1, {
                            x: r,
                            y: s,
                            ease: Power2.easeOut
                        });
                        break;
                    case "transform3d":
                        TweenMax.to(t[0], 2, {
                            x: r,
                            y: s,
                            z: d,
                            rotationX: u,
                            rotationY: -c,
                            ease: Power2.easeOut
                        })
                }
            })
        }
    }
}(jQuery, window.elementorFrontend);