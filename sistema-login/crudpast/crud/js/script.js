document.addEventListener("DOMContentLoaded", function() {
    // Seleciona o botão "Limpar Campos"
    const btnLimpar = document.getElementById("btn-limpar");

    // Adiciona um evento de clique ao botão "Limpar Campos"
    btnLimpar.addEventListener("click", function() {
        // Limpa os campos do formulário
        document.getElementById("form-aluno").reset();
    });

    // Seleciona o formulário de adicionar aluno
    const form = document.getElementById("form-aluno");

    // Adiciona um evento de envio ao formulário
    form.addEventListener("submit", function(event) {
        // Previne o envio padrão do formulário
        event.preventDefault();

        // Envia os dados do formulário via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/adicionar_aluno.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Exibe um alerta com a mensagem retornada pelo servidor
                    alert(xhr.responseText);
                    // Redireciona para a tela de pesquisa
                    window.location.href = "pesquisar_aluno.php";
                } else {
                    // Exibe um alerta de erro se ocorrer um erro na requisição AJAX
                    alert("Erro na requisição: " + xhr.status);
                }
            }
        };
        xhr.send(new FormData(form));
    });
});
