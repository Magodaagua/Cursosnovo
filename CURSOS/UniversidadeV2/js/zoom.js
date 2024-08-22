//----------------------[ Botão zoom ]-------------------------------//
document.getElementById('botao-zoom').addEventListener('click', function() {
    var imagem = document.getElementById('botao-zoom').querySelector('img');
    if (document.fullscreenElement) {
      document.exitFullscreen();
      imagem.src = '../../COMUM/img/Icons/CinzaMedio/fullScreen.png';
    } else {
      document.documentElement.requestFullscreen();
      imagem.src = '../../COMUM/img/Icons/CinzaMedio/telaInteira.png';
    }
});
