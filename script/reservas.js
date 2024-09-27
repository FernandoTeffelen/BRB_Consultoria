// Script para adicionar mais campos de imagem
let imageCount = 5;
document.getElementById('add-more-images').addEventListener('click', function() {
    imageCount++;
    const newField = document.createElement('div');
    newField.innerHTML = `
        <label for="image${imageCount}">Imagem ${imageCount}:</label>
        <input type="file" id="image${imageCount}" name="images[]" accept="image/*">
    `;
    document.getElementById('image-fields').appendChild(newField);
});


// Script para carregar os dados enviados
document.addEventListener('DOMContentLoaded', function () {
    const dataSent = document.querySelectorAll('.sent-data');
    const container = document.querySelector('.row.gx-4');

    dataSent.forEach(item => {
        const propertyDiv = document.getElementById('property-template').cloneNode(true);
        propertyDiv.style.display = 'block';
        propertyDiv.querySelector('.property-name').innerText = item.querySelector('span').innerText;
        propertyDiv.querySelector('.property-neighborhood').innerText = item.querySelector('span:nth-of-type(2)').innerText;

        const carouselInner = propertyDiv.querySelector('.carousel-inner');
        const images = item.querySelectorAll('img');
        
        images.forEach((image, index) => {
            const carouselItem = document.createElement('div');
            carouselItem.classList.add('carousel-item');
            if (index === 0) carouselItem.classList.add('active');
            carouselItem.innerHTML = `<img class="d-block w-100" src="${image.src}" alt="Image">`;
            carouselInner.appendChild(carouselItem);
        });

        container.appendChild(propertyDiv);
    });
});
