

document.addEventListener('DOMContentLoaded', () => {
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    if (scrollTopBtn) {
        // Показываем/скрываем кнопку при прокрутке
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        });

        // Плавная прокрутка наверх по клику
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});