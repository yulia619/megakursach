document.addEventListener('DOMContentLoaded', function() {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide-one');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    
    if(slides.length && prevBtn && nextBtn) {
        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
        nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
        
        setInterval(() => showSlide(currentSlide + 1), 5000);
    }

    const calcBtn = document.getElementById('calc-btn');
    
    if(calcBtn) {
        calcBtn.addEventListener('click', function() {
            const from = document.getElementById('from').value;
            const to = document.getElementById('to').value;
            const weight = parseFloat(document.getElementById('weight').value) || 0;
            const volume = parseFloat(document.getElementById('volume').value) || 0;
            
            let price = weight * 50 + volume * 2000;
            
            if(from.toLowerCase() !== to.toLowerCase()) {
                price += 3000;
            }
            
            const resultDiv = document.getElementById('result');
            const priceSpan = document.getElementById('price');
            
            if(priceSpan && resultDiv) {
                priceSpan.textContent = price;
                resultDiv.style.display = 'block';
            }
        });
    }

    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.menu');
    
    if(burger && menu) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('active');
            menu.classList.toggle('show');
        });
    }
});