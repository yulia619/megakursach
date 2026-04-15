// Ждём загрузки страницы
document.addEventListener('DOMContentLoaded', function() {
    // СЛАЙДЕР 
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide-one');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    
    if(slides.length && prevBtn && nextBtn) {
        // Функция переключения слайда
        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        // Обработчики кнопок
        prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
        nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
        
        // Автосмена каждые 5 секунд
        setInterval(() => showSlide(currentSlide + 1), 5000);
    }

    // КАЛЬКУЛЯТОР СТОИМОСТИ 
    const calcBtn = document.getElementById('calc-btn');
    
    if(calcBtn) {
        calcBtn.addEventListener('click', function() {
            // Получаем значения из полей
            const from = document.getElementById('from').value;
            const to = document.getElementById('to').value;
            const weight = parseFloat(document.getElementById('weight').value) || 0;
            const volume = parseFloat(document.getElementById('volume').value) || 0;
            
            // Формула расчёта: вес * 50 + объём * 2000
            let price = weight * 50 + volume * 2000;
            
            // Если города разные, добавляем 3000 руб
            if(from.toLowerCase() !== to.toLowerCase()) {
                price += 3000;
            }
            
            // Показываем результат
            const resultDiv = document.getElementById('result');
            const priceSpan = document.getElementById('price');
            
            if(priceSpan && resultDiv) {
                priceSpan.textContent = price;
                resultDiv.style.display = 'block';
            }
        });
    }

    // ГАМБУРГЕР-МЕНЮ 
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.menu');
    
    if(burger && menu) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('active');  // Анимация бургера
            menu.classList.toggle('show');     // Показать/скрыть меню
        });
    }

    // ОТСЛЕЖИВАНИЕ ГРУЗА 
    const trackBtn = document.getElementById('track-btn');
    
    if(trackBtn && typeof cargosData !== 'undefined') {
        trackBtn.addEventListener('click', function() {
            const number = document.getElementById('track-number').value;
            
            // Ищем груз по номеру накладной
            const found = cargosData.find(cargo => cargo.tracking_number === number);
            
            if(found) {
                // Показываем результат
                document.getElementById('status').textContent = found.status;
                document.getElementById('location').textContent = found.location;
                document.getElementById('track-result').style.display = 'block';
            } else {
                alert('Накладная не найдена');
            }
        });
    }
});