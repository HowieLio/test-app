let editProductId = null;
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.tr-body');
    rows.forEach(row => {
        row.addEventListener('click', () => {
            editProductId = row.getAttribute('data-product-id');
            const productArticle = row.getAttribute('data-product-article');
            const productName = row.getAttribute('data-product-name');
            const productStatus = row.getAttribute('data-product-status');
            const productAttributes = JSON.parse(row.getAttribute('data-product-attributes'));

            document.getElementById('editProductId').value = editProductId;
            document.getElementById('infoArticle').textContent = productArticle;
            document.getElementById('infoName').textContent = productName;
            document.getElementById('infoStatus').textContent = productStatus === 'available' ? 'Доступен' : 'Недоступен';

            const editNameInput = document.getElementById('editName');
            const editArticleInput = document.getElementById('editArticle');
            const editStatusInput = document.getElementById('editStatus');
            editNameInput.value = productName;
            editArticleInput.value = productArticle;
            editStatusInput.value = productStatus;
            document.getElementById('editAttributesInputContainer').innerHTML = '';
            for (let key in productAttributes) {
                if (productAttributes.hasOwnProperty(key)) {
                    generateInputs('editAttributesInputContainer', key, productAttributes[key]);
                }
            }
            const attributesContainer = document.getElementById('infoAttributes');
            attributesContainer.innerHTML = '';

            for (const [key, value] of Object.entries(productAttributes)) {
                const attributeElement = document.createElement('p');
                attributeElement.textContent = `${key}: ${value}`;
                attributesContainer.appendChild(attributeElement);
            }

            document.getElementById('infoModal').style.display = 'flex';
        });
    });
});

function handleDeleteButton() {
    if (editProductId) {
        fetch(`/products/delete/${editProductId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            closeInfoModal(); // Закрываем модальное окно после удаления
        }).catch(error => {
            console.error('Ошибка запроса на удаление:', error);
        });
    }
}

