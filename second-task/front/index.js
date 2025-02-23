document.addEventListener('DOMContentLoaded', () => {
    const gridContainer = document.getElementById('gridContainer');
    const modal = document.getElementById('productModal');
    const productName = document.getElementById('productName');
    const productPrice = document.getElementById('productPrice');
    const closeButton = document.querySelector('.close');

    setupModalListeners(modal, closeButton);
    fetchCollections(gridContainer);
});

function openModal(name, price, productName, productPrice, modal) {
    productName.textContent = name;
    productPrice.textContent = `Цена: ${price}`;
    modal.style.display = 'flex';
}

function closeModal(modal) {
    modal.style.display = 'none';
}

// Настройка обработчиков событий для модального окна
function setupModalListeners(modal, closeButton) {
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal(modal);
        }
    });
    
    closeButton.addEventListener('click', () => closeModal(modal));
}

// Загрузка данных о коллекциях
function fetchCollections(gridContainer) {
    fetch('http://localhost/second-task/src/public/api/collections')
        .then(handleFetchResponse)
        .then(data => renderCollections(data, gridContainer))
        .catch(error => handleFetchError(error, gridContainer));
}

// Обработка ответа от fetch
function handleFetchResponse(response) {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }

    return response.json();
}

function handleFetchError(error, gridContainer) {
    console.error('Error fetching collections:', error);
    gridContainer.innerHTML = '<div class="grid-item">Ошибка загрузки данных</div>';
}

// Отрисовка коллекций и продуктов
function renderCollections(data, gridContainer) {
    let column = 0;

    data.data.forEach(collection => {
        column = renderCollection(collection, gridContainer, column);
        column = renderProducts(collection.products, gridContainer, column);
    });
}

function renderCollection(collection, gridContainer, column) {
    let collectionDiv = document.createElement('div');
    collectionDiv.className = 'grid-item collection';

    if (column === 2) {
        collectionDiv.className = 'grid-item';
        gridContainer.appendChild(collectionDiv);

        collectionDiv = document.createElement('div');
        collectionDiv.className = 'grid-item collection';
        column = 0;
    }

    collectionDiv.id = collection.collection_id;
    collectionDiv.textContent = collection.collection_name;
    gridContainer.appendChild(collectionDiv);

    return column + 1;
}

function renderProducts(products, gridContainer, column) {
    products.forEach(product => {
        column = createProductElement(product, gridContainer, column);
    });

    return column;
}

function createProductElement(product, gridContainer, column) {
    const productDiv = document.createElement('div');
    productDiv.className = 'grid-item product';
    productDiv.id = product.id;
    productDiv.textContent = product.name;
    gridContainer.appendChild(productDiv);

    productDiv.addEventListener('click', () => fetchProductDetails(product));

    return column === 2 ? 0 : column + 1;
}

async function fetchProductDetails(product) {
    const modal = document.getElementById('productModal');
    const productName = document.getElementById('productName');
    const productPrice = document.getElementById('productPrice');

    try {
        const response = await fetch(`http://localhost/second-task/src/public/api/product/${product.id}`);

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const productData = await response.json();
        openModal(product.name, productData.data.price, productName, productPrice, modal);
    } catch (error) {
        console.error('Error fetching product details:', error);
        openModal(product.name, 'Цена недоступна', productName, productPrice, modal);
    }
}