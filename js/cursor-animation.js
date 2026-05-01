/*global jQuery, $, Swiper*/
$ = jQuery;

$(document).ready(function () {
    'use strict';

    const dot = document.querySelector('.cursor-dot');
    const glow = document.querySelector('.cursor-glow');

    const hideZones = document.querySelectorAll('header, footer');

    hideZones.forEach(zone => {
        zone.addEventListener('mouseenter', () => {
            document.body.classList.add('cursor-hidden');
        });

        zone.addEventListener('mouseleave', () => {
            document.body.classList.remove('cursor-hidden');
        });
    });

    let mouseX = 0;
    let mouseY = 0;

    let glowX = 0;
    let glowY = 0;

    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        dot.style.left = mouseX + 'px';
        dot.style.top = mouseY + 'px';
    });

    function animate() {
        glowX += (mouseX - glowX) * 0.1;
        glowY += (mouseY - glowY) * 0.1;

        glow.style.left = glowX + 'px';
        glow.style.top = glowY + 'px';

        requestAnimationFrame(animate);
    }

    animate();

    const interactive = document.querySelectorAll('a, button');

    interactive.forEach(el => {
        el.addEventListener('mouseenter', () => {
            document.body.classList.add('cursor-hover');
        });

        el.addEventListener('mouseleave', () => {
            document.body.classList.remove('cursor-hover');
        });
    });
});