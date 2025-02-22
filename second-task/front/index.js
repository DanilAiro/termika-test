document.addEventListener("DOMContentLoaded", async () => {
    const catalog = document.getElementById("catalog");
    
    try {
        const response = await fetch("http://localhost/api/collections");
        const data = await response.json();

        data.data.forEach(collection => {
            const collectionEl = document.createElement("div");
            collectionEl.className = "collection";
            collectionEl.textContent = collection.collection_name;
            catalog.appendChild(collectionEl);
        });
    } catch (error) {
        catalog.innerHTML = '<p>Ошибка загрузки: ${error.message}</p>';
    }
});
