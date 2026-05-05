const GlassEffect = (function () {

    const N          = 16;    /* number of vertical strips */
    const MAX_ANGLE  = 75;    /* max rotation angle in degrees */
    const SIGMA_MULT = 3.0;   /* gaussian spread — larger = wider wave */
    const DARK_PEAK  = 0.82;  /* max dark opacity at cursor center */

    function gauss(x, sigma) {
        return Math.exp(-(x * x) / (2 * sigma * sigma));
    }

    function lerp(a, b, t) {
        return a + (b - a) * t;
    }

    function initCard(figure) {
        if (figure.dataset.glassInit) return;
        figure.dataset.glassInit = '1';

        const stripsWrap = figure.querySelector('.glass-strips');
        if (!stripsWrap) return;

        /* Build strip elements */
        const strips = Array.from({ length: N }, () => {
            const strip = document.createElement('div');
            strip.className = 'gs';

            /* Dark blind layer */
            const blind = document.createElement('div');
            blind.className = 'gs-blind';

            /* Glass shimmer layer */
            const glass = document.createElement('div');
            glass.className = 'gs-glass';

            strip.appendChild(blind);
            strip.appendChild(glass);
            stripsWrap.appendChild(strip);

            return { strip, blind, glass };
        });

        /* Animation state */
        const ang   = new Float32Array(N);
        const tAng  = new Float32Array(N);
        const dOpa  = new Float32Array(N);
        const tDOpa = new Float32Array(N);

        let mx = 0, my = 0, isHover = false, rafId = null;

        function tick() {
            const rect = figure.getBoundingClientRect();
            const relX = mx - rect.left;
            const sw   = rect.width / N;

            let settled = true;

            for (let i = 0; i < N; i++) {
                const cx   = (i + 0.5) * sw;
                const dist = relX - cx;

                if (isHover) {
                    const prox = gauss(dist, sw * SIGMA_MULT);
                    const sign = dist > 0 ? -1 : 1;
                    tAng[i]  = sign * prox * MAX_ANGLE;
                    tDOpa[i] = prox * DARK_PEAK;
                } else {
                    /* Rest: fully transparent, no rotation */
                    tAng[i]  = 0;
                    tDOpa[i] = 0;
                }

                const speed = isHover ? 0.11 : 0.065;
                ang[i]  = lerp(ang[i],  tAng[i],  speed);
                dOpa[i] = lerp(dOpa[i], tDOpa[i], speed);

                if (
                    Math.abs(ang[i]  - tAng[i])  > 0.04 ||
                    Math.abs(dOpa[i] - tDOpa[i]) > 0.004
                ) settled = false;

                const { strip, blind, glass } = strips[i];
                strip.style.transform = `rotateY(${ang[i]}deg)`;

                const openRatio = Math.abs(ang[i]) / MAX_ANGLE;

                /* Dark blind fades in as strip rotates */
                blind.style.opacity = Math.max(0, dOpa[i]).toFixed(3);

                /* Glass shimmer peaks mid-rotation (sin curve) */
                const shimmer = openRatio > 0.05
                    ? Math.sin(openRatio * Math.PI) * 1.1
                    : 0;
                glass.style.opacity = Math.min(shimmer, 1).toFixed(3);

                /* Edge refraction glow */
                if (openRatio > 0.08) {
                    const dir = ang[i] > 0 ? -1 : 1;
                    const s   = openRatio * 0.8;
                    strip.style.boxShadow = [
                        `inset ${dir * 4}px 0 10px rgba(120, 220, 190, ${(s * 0.55).toFixed(2)})`,
                        `inset 0 0 18px rgba(255, 255, 255, ${(s * 0.07).toFixed(2)})`
                    ].join(', ');
                } else {
                    strip.style.boxShadow = '';
                }
            }

            if (!settled || isHover) {
                rafId = requestAnimationFrame(tick);
            } else {
                rafId = null;
            }
        }

        figure.addEventListener('mouseenter', function (e) {
            isHover = true;
            mx = e.clientX;
            my = e.clientY;
            if (!rafId) rafId = requestAnimationFrame(tick);
        });

        figure.addEventListener('mousemove', function (e) {
            mx = e.clientX;
            my = e.clientY;
        });

        figure.addEventListener('mouseleave', function () {
            isHover = false;
            if (!rafId) rafId = requestAnimationFrame(tick);
        });
    }

    function init(scope) {
        const root = scope || document;
        root.querySelectorAll('figure.glass_effect').forEach(initCard);
    }

    return { init };

})();

/* Auto-init on DOMContentLoaded */
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { GlassEffect.init(); });
} else {
    GlassEffect.init();
}