</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Theme Toggle Script -->
<script>
    (() => {
        'use strict'

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector('#bd-theme')

            if (!themeSwitcher) {
                return
            }

            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = document.querySelector('.theme-icon-active use')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                element.classList.remove('active')
                element.setAttribute('aria-pressed', 'false')
            })

            btnToActive.classList.add('active')
            btnToActive.setAttribute('aria-pressed', 'true')
            activeThemeIcon.setAttribute('href', svgOfActiveBtn)
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

            if (focus) {
                themeSwitcher.focus()
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme()
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
                setTheme(getPreferredTheme())
            }
        })

        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())

            document.querySelectorAll('[data-bs-theme-value]')
                .forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value')
                        setStoredTheme(theme)
                        setTheme(theme)
                        showActiveTheme(theme, true)
                    })
                })
        })
    })()
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const words = ["Welcome", "Hallo", "Bonjour", "こんにちは", "안녕하세요", "مرحبا"];
        const target = document.getElementById("typing-ios");
        let index = 0;

        function showNextWord() {
            target.classList.remove("ios-typing"); // reset animasi
            void target.offsetWidth; // force reflow
            target.textContent = words[index];
            target.classList.add("ios-typing");

            index = (index + 1) % words.length;
            setTimeout(showNextWord, 3000); // tiap 3 detik ganti
        }

        showNextWord();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        const hasError = form && form.querySelector(".is-invalid");

        if (hasError) {
            // Tambahkan animasi shake jika belum ada
            const style = document.createElement("style");
            style.textContent = `
                @keyframes shake {
                    0% { transform: translateX(0); }
                    20% { transform: translateX(-8px); }
                    40% { transform: translateX(8px); }
                    60% { transform: translateX(-8px); }
                    80% { transform: translateX(8px); }
                    100% { transform: translateX(0); }
                }
                .shake {
                    animation: shake 0.4s ease;
                }
            `;
            document.head.appendChild(style);

            // Tambahkan kelas shake ke form
            form.classList.add("shake");

            // Hapus kelas setelah animasi selesai agar bisa di-trigger ulang nanti
            form.addEventListener("animationend", () => {
                form.classList.remove("shake");
            });
        }
    });
</script>



</body>

</html>
