// Atribui uma função ao botão buscar
document.getElementById("get-cat-btn").addEventListener("click", function(event){
    event.preventDefault();

    // Busca o campo da imagem que vai ser alterado
    const catImage = document.getElementById('cat-image');

    // Conecta ao PHP para buscar nova imagem de gato
    fetch('get_cat.php')
        .then(response => response.json())
        .then(data => {
            // Vai entrar aqui se der certo a comunicação 
            catImage.src = data.image;
        })
        .catch(error => {
            // Vai entrar aqui se der errado a comunicação 
            console.log('Erro:', error);
        });
});