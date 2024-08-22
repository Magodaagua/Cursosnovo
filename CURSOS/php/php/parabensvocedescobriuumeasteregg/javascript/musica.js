document.addEventListener("DOMContentLoaded", function() {
  const musicas = [
      "musica/StarWarsMainTheme.mp3",
      "musica/FrankSinatraYouveGotaFriendinMe.mp3",
      "musica/SuperMario64.mp3",
      "musica/EarthwormJimPsyCrow.mp3",
      "musica/EarthwormJimNewJunkCity.mp3",
      "musica/WaterflameGloriousMorningExtended.mp3"
      // Adicione mais músicas conforme necessário
  ];

  let indiceMusicaAtual = 0;
  const player = document.getElementById("audioPlayer");

  function musicaAnterior() {
      indiceMusicaAtual--;
      if (indiceMusicaAtual < 0) {
          indiceMusicaAtual = musicas.length - 1;
      }
      player.src = musicas[indiceMusicaAtual];
      player.play();
  }

  function proximaMusica() {
      indiceMusicaAtual++;
      if (indiceMusicaAtual >= musicas.length) {
          indiceMusicaAtual = 0;
      }
      player.src = musicas[indiceMusicaAtual];
      player.play();
  }

  function mostrarListaMusicas() {
      const lista = document.getElementById("musicas");
      lista.innerHTML = "";
      musicas.forEach((musica, indice) => {
          const item = document.createElement("li");
          item.textContent = musica;
          item.addEventListener("click", () => {
              indiceMusicaAtual = indice;
              player.src = musica;
              player.play();
          });
          lista.appendChild(item);
      });
      document.getElementById("listaMusicasModal").style.display = "block";
  }

  window.onclick = function(event) {
      if (event.target == document.getElementById("listaMusicasModal")) {
          document.getElementById("listaMusicasModal").style.display = "none";
      }
  }

  document.getElementById("fecharModal").addEventListener("click", function() {
      document.getElementById("listaMusicasModal").style.display = "none";
  });

  document.getElementById("botaoAnterior").addEventListener("click", musicaAnterior);

  document.getElementById("botaoProxima").addEventListener("click", proximaMusica);

  document.getElementById("botaoLista").addEventListener("click", mostrarListaMusicas);  

  player.src = musicas[indiceMusicaAtual];

  // Novo código para tocar som ao passar o mouse sobre imagens específicas
  const images = document.querySelectorAll('img[data-sound]');
  let currentAudio = null;

  images.forEach(function(image) {
      image.addEventListener('mouseenter', function() {
          const soundSrc = image.getAttribute('data-sound');
          const gifSrc = image.getAttribute('data-gif');
          image.src = gifSrc;

          if (currentAudio) {
              currentAudio.pause();
              currentAudio.currentTime = 0;
          }

          currentAudio = new Audio(soundSrc);
          currentAudio.loop = true; // Tocar em loop
          currentAudio.play();
      });

      image.addEventListener('mouseleave', function() {
          const staticSrc = image.getAttribute('data-static');
          image.src = staticSrc;

          if (currentAudio) {
              currentAudio.pause();
              currentAudio.currentTime = 0;
              currentAudio = null;
          }
      });
  });
});
