/*global jQuery, $, Swiper*/
$ = jQuery;

// control :focus when using mouse/keyboard
document.body.addEventListener('mousedown', function () {
    document.body.classList.add('is_using_mouse');
});
document.body.addEventListener('keydown', function () {
    document.body.classList.remove('is_using_mouse');
});


// const canvas = document.getElementById("starfield");
// const ctx = canvas.getContext("2d");
//
// let stars = [];
// let shootingStars = [];
//
// let nextMeteorTime = Date.now() + randomInterval();
// let lastInteraction = Date.now();
//
// /* ---------- canvas size ---------- */
//
// function resizeCanvas(){
//     canvas.width = window.innerWidth;
//     canvas.height = window.innerHeight;
// }
// window.addEventListener("resize", resizeCanvas);
// resizeCanvas();
//
// /* ---------- helpers ---------- */
//
// function randomInterval(){
//     return Math.random() * (7000 - 5000) + 5000; // 5-7 seconds
//     // return 7000 + Math.random() * 3000; // 7-10 seconds
// }
//
// /* ---------- user activity ---------- */
//
// ["mousemove","scroll","keydown","touchstart"].forEach(evt=>{
//     window.addEventListener(evt, ()=>{
//         lastInteraction = Date.now();
//     });
// });
//
// /* ---------- stars ---------- */
//
// for(let i=0;i<220;i++){
//
//     stars.push({
//         x:Math.random()*canvas.width,
//         y:Math.random()*canvas.height,
//         r:Math.random()*1.4,
//         alpha:Math.random()*0.8+0.2,
//         twinkle:Math.random()>0.85,
//         phase:Math.random()*Math.PI*2,
//         speed:0.003 + Math.random()*0.003
//     });
//
// }
//
// function drawStars(){
//
//     stars.forEach(star=>{
//
//         if(star.twinkle){
//
//             star.phase += star.speed;
//             star.alpha = 0.4 + Math.sin(star.phase)*0.4;
//
//         }
//
//         ctx.globalAlpha = star.alpha;
//
//         ctx.beginPath();
//         ctx.arc(star.x,star.y,star.r,0,Math.PI*2);
//         ctx.fillStyle="white";
//         ctx.fill();
//
//     });
//
// }
//
// /* ---------- shooting star ---------- */
//
// function createShootingStar(){
//
//     shootingStars.push({
//
//         x:Math.random()*canvas.width,
//         y:Math.random()*canvas.height*0.4,
//
//         speed:10,
//         length:60 + Math.random()*40, // max 100px
//
//         life:0,
//         maxLife:30,
//
//         headSize:2 + Math.random()*1.5
//
//     });
//
// }
//
// function drawShootingStars(){
//
//     shootingStars.forEach((star,i)=>{
//
//         const tailX = star.x + star.length;
//         const tailY = star.y - star.length;
//
//         const gradient = ctx.createLinearGradient(
//             star.x,star.y,
//             tailX,tailY
//         );
//
//         gradient.addColorStop(0,"rgba(255,255,255,1)");
//         gradient.addColorStop(0.3,"rgba(255,255,255,0.6)");
//         gradient.addColorStop(1,"rgba(255,255,255,0)");
//
//         ctx.strokeStyle = gradient;
//         ctx.lineWidth = star.headSize;
//
//         ctx.beginPath();
//         ctx.moveTo(star.x,star.y);
//         ctx.lineTo(tailX,tailY);
//         ctx.stroke();
//
//         /* head */
//
//         ctx.beginPath();
//         ctx.arc(star.x,star.y,star.headSize,0,Math.PI*2);
//         ctx.fillStyle="white";
//         ctx.fill();
//
//         /* movement */
//
//         star.x -= star.speed;
//         star.y += star.speed;
//
//         star.life++;
//
//         if(star.life>star.maxLife){
//             shootingStars.splice(i,1);
//         }
//
//     });
//
// }
//
// /* ---------- animation ---------- */
//
// function animate(){
//
//     ctx.clearRect(0,0,canvas.width,canvas.height);
//
//     drawStars();
//     drawShootingStars();
//
//     /* meteor spawn logic */
//
//     const now = Date.now();
//
//     const idle = now - lastInteraction > 4000;
//
//     if(idle && now > nextMeteorTime){
//
//         createShootingStar();
//         nextMeteorTime = now + randomInterval();
//
//     }
//
//     requestAnimationFrame(animate);
//
// }
//
// animate();






class StarField {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext("2d");
        this.stars = [];
        this.shootingStar = null;
        this.nextShootAt = Date.now() + 2000 + Math.random() * 3000;
        this.animId = null;

        this.resize = this.resize.bind(this);
        this.draw = this.draw.bind(this);

        this.resize();
        window.addEventListener("resize", this.resize);
        this.animId = requestAnimationFrame(this.draw);
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
        this.generateStars();
    }

    generateStars() {
        const count = 120 + Math.floor(Math.random() * 30);
        this.stars = [];

        for (let i = 0; i < count; i++) {
            const brightness = 0.4 + Math.random() * 0.35;
            const tint = Math.random();
            let color;

            // Assign star color based on tint probability
            if (tint < 0.85) {
                color = `rgba(255,255,255,${brightness})`;
            } else if (tint < 0.93) {
                color = `rgba(255,245,230,${brightness})`;  // warm tint
            } else {
                color = `rgba(220,235,255,${brightness})`;  // cool tint
            }

            this.stars.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                // 10% chance of a larger star
                r: Math.random() < 0.9
                    ? 0.4 + Math.random() * 0.6
                    : 0.8 + Math.random() * 0.7,
                color,
            });
        }
    }

    spawnShootingStar() {
        const fromTop = Math.random() > 0.4;

        this.shootingStar = {
            x: fromTop ? Math.random() * this.canvas.width * 0.8 : 0,
            y: fromTop ? 0 : Math.random() * this.canvas.height * 0.5,
            len: 80 + Math.random() * 40,
            speed: 600 + Math.random() * 300,
            opacity: 1,
            startTime: Date.now(),
            duration: 600 + Math.random() * 300,
        };
    }

    draw() {
        const { ctx, canvas } = this;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Draw static stars
        for (const s of this.stars) {
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = s.color;
            ctx.fill();
        }

        const now = Date.now();

        // Spawn shooting star when timer fires
        if (!this.shootingStar && now >= this.nextShootAt) {
            this.spawnShootingStar();
        }

        if (this.shootingStar) {
            const ss = this.shootingStar;
            const elapsed = now - ss.startTime;
            const progress = Math.min(elapsed / ss.duration, 1);
            const dist = progress * ss.speed;
            const angle = Math.PI / 4; // 45° diagonal

            const headX = ss.x + Math.cos(angle) * dist;
            const headY = ss.y + Math.sin(angle) * dist;
            const tailX = headX - Math.cos(angle) * ss.len;
            const tailY = headY - Math.sin(angle) * ss.len;

            const opacity = 1 - progress;

            // Gradient from transparent tail to opaque head
            const grad = ctx.createLinearGradient(tailX, tailY, headX, headY);
            grad.addColorStop(0, `rgba(224,255,245,0)`);
            grad.addColorStop(1, `rgba(224,255,245,${opacity})`);

            ctx.beginPath();
            ctx.moveTo(tailX, tailY);
            ctx.lineTo(headX, headY);
            ctx.strokeStyle = grad;
            ctx.lineWidth = 1.5;
            ctx.stroke();

            // Reset after animation completes
            if (progress >= 1) {
                this.shootingStar = null;
                this.nextShootAt = now + 4000 + Math.random() * 5000;
            }
        }

        this.animId = requestAnimationFrame(this.draw);
    }

    destroy() {
        window.removeEventListener("resize", this.resize);
        cancelAnimationFrame(this.animId);
    }
}

// --- Usage ---
const canvas = document.createElement("canvas");
Object.assign(canvas.style, {
    position: "fixed",
    inset: "0",
    width: "100vw",
    height: "100vh",
    pointerEvents: "none",
    zIndex: "-1",
});
document.body.appendChild(canvas);

const starField = new StarField(canvas);

// Call starField.destroy() to stop the animation and remove listeners

$(document).ready(function () {
    'use strict';



    // variables
    const body = $('body');
    const header = $('header');
    const menu__toggle = $('.menu__toggle');
    const menu__primary = $('.menu__primary');
    const menu__a_parent = menu__primary.find('.menu-item-has-children > a');


    // hamburger + menu
    menu__toggle.on('click', function () {
        $(this).toggleClass('is_active');
        menu__primary.stop().toggleClass('is_open');
        body.toggleClass('is_overflow');
    });
    // close menu with Esc key
    body.on('keyup', function (e) {
        if (e.keyCode === 27 && menu__toggle.hasClass('is_active')) {
            $('.menu__toggle.is_active').click();
            $('a[href="#main"]').focus();
        }
    });
    // open/close sub-menu with Tab key
    menu__a_parent.on('focus', function () {
        $(this).parent().addClass('is_focused');
    });
    menu__primary.find('.sub-menu').each(function () {
        const sub_menu_links = $(this).find('> li > a');
        const last_sub_menu_link = sub_menu_links.last();
        last_sub_menu_link.on('blur', function () {
            $(this).parents('.menu-item-has-children').removeClass('is_focused');
        });
    });
    // option to make parent element hidden from screen readers
    // menu__a_parent.attr({
    //     'aria-hidden': 'true',
    //     'tabindex': -1
    // });
    // append "plus" element in sub-menu parent item
    menu__a_parent.after('<span class="rwd_show" tabindex="0" role="button" aria-label="Sub-menu toggle" aria-expanded="false" />');

    function sub_menu_action(elem) {
        const exp = elem.attr('aria-expanded');
        (exp === 'false') ? elem.attr('aria-expanded', 'true') : elem.attr('aria-expanded', 'false');
        elem.toggleClass('is_open').next().stop().toggle();
    }

    menu__primary.on('click', '[aria-label="Sub-menu toggle"]', function () {
        sub_menu_action($(this));
    }).on('keyup', '[aria-label="Sub-menu toggle"]', function (e) {
        if (e.keyCode === 13) {
            sub_menu_action($(this));
        }
    });


    // header
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 5) {
            header.addClass('is_sticky');
        } else {
            header.removeClass('is_sticky');
        }
    });
    if ($(this).scrollTop() > 4) header.addClass('is_sticky');

    // custom select
    if ($('select').length > 0) {
        $('select').selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
            arrowButtonMarkup: '<span class="select_arrow"></span>'
        });
        // $('select.wpcf7-form-control').each(function () {
        //     $(this).find('option').first().val('');
        // });
    }


    // fancybox
    $('[data-fancybox]').fancybox({
        touch: {
            vertical: false,
            momentum: true
        },
        smallBtn: false,
        beforeLoad: function (instance, slide) {
            // fix if header is sticky
            header.addClass('compensate-for-scrollbar');
        },
        afterClose: function (instance, slide) {
            // fix if header is sticky
            header.removeClass('compensate-for-scrollbar');
            // remove body class after event
            if (body.hasClass('is_searching')) {
                body.removeClass('is_searching');
            }
        }
    });


    // add body class on event
    $('.search_toggle').on('click', function () {
        body.addClass('is_searching');
    });


    // animations
    // AOS.init({
    // disable: true,
    // disable: 'mobile',
    // once: true,
    // offset: 150,
    // duration: 600,
    // easing: 'ease-in-out'
    // });


    // scroll to
    $('a[data-scrollto]').on('click', function () {
        const anchor = $(this).data('scrollto');

        if ($(anchor).length > 0) {
            $('html, body').animate({
                scrollTop: $(anchor).offset().top - header.outerHeight()
            }, 700);
        }
    });

    // wrap tables for responsive design
    if ($('.content table').length > 0) {
        $('.content table').wrap('<div class="table_wrapper"></div>');
    }

    //if .content has .button + .button wrap in div
    if ($('.content .button').length > 0) {
        $('.content .button').each(function () {
            const t = $(this),
                n = t.next();
            if (n.hasClass('button')) {
                t.add(n).wrapAll('<div class="button_group"></div>');
            }
        });
    }

});


$(window).on('load', function () {
    'use strict';

    // custom class for video in content (iframe)
    $('.content iframe').each(function (i) {
        const t = $(this),
            p = t.parent();
        if ((p.is('p') || p.is('span')) && !p.hasClass('full_frame')) {
            p.addClass('full_frame');
        }
    });

});


// close on click outside
// $(document).on('mouseup', function(e) {
//     let menu = $('.menu__primary');
//
//     if (!menu.is(e.target) && !$('.menu__toggle.is_active').is(e.target) && menu.has(e.target).length === 0 && menu.hasClass('is_open')) {
//         $('.menu__toggle.is_active').click();
//     }
// });


// proper resize event
// $(window).resizeEnd(function() {
//     'use strict';
//
// });