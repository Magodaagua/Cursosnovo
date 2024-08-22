<!doctype html>
<html lang="pt-br">
  <!--coloca o icone na aba da tela-->
  <link rel="icon" type="png" href="../../../../../../COMUM/img/Icons/Vermelho/imgML13.png">
  <!-- Conexão com o banco de dados -->
  <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once("conexao.php");

    //pega o id do usuário e do grupo passado pela URL
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

    $result_usuario = "SELECT * FROM usuario WHERE Usuario = '$usuario' ";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
        $id_user = $row_usuario['ID_usuario'];
        $dep = $row_usuario['Dep'];
        $nome_usuario = $row_usuario['Nome'];
    }
  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Easter egg</title>
    <!--CSS -->
    <link href="https://fonts.cdnfonts.com/css/community" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script>
      window.google={kEI:"Quz2S63qIYeglAfw8oHGCg",kEXPI:"17259,23663,24477,24661,24745,24770,24808",kCSI:{e:"17259,23663,24477,24661,24745,24770,24808",ei:"Quz2S63qIYeglAfw8oHGCg",expi:"17259,23663,24477,24661,24745,24770,24808"},ml:function(){},pageState:"#",kHL:"en",time:function(){return(new Date).getTime()},log:function(b,d,c){var a=new Image,e=google,g=e.lc,f=e.li;a.onerror=(a.onload=(a.onabort=function(){delete g[f]}));g[f]=a;c=c||"/gen_204?atyp=i&ct="+b+"&cad="+d+"&zx="+google.time();a.src=c;e.li=f+1},lc:[],li:0,j:{en:1,l:function(){},e:function(){},b:location.hash&&location.hash!="#",bv:3,pl:[],mc:0,sc:0.5},Toolbelt:{}};(function(){for(var d=0,c;c=["ad","bc","p","pa","zd","ac","pc","pah","ph","sa","xx","zc","zz"][d++];)(function(a){google.j[a]=function(){google.j.pl.push([a,arguments])}})(c)})();
      window.google.sn="webhp";window.google.timers={load:{t:{start:(new Date).getTime()}}};try{window.google.pt=window.gtbExternal&&window.gtbExternal.pageT();}catch(u){}window.google.jsrt_kill=1;
    </script>
    <script>
      var _gjwl=location;function _gjuc(){var b=_gjwl.href.indexOf("#");if(b>=0){var a=_gjwl.href.substring(b+1);if(/(^|&)q=/.test(a)&&a.indexOf("#")==-1&&!/(^|&)cad=h($|&)/.test(a)){_gjwl.replace("/search?"+a.replace(/(^|&)fp=[^&]*/g,"")+"&cad=h");return 1}}return 0}function _gjp(){!(window._gjwl.hash&&window._gjuc())&&setTimeout(_gjp,500)};
      google.y={};google.x=function(e,g){google.y[e.id]=[e,g];return false};if(!window.google)window.google={};window.google.crm={};window.google.cri=0;window.clk=function(e,f,g,k,l,b,m){if(document.images){var a=encodeURIComponent||escape,c=new Image,h=window.google.cri++;window.google.crm[h]=c;c.onerror=(c.onload=(c.onabort=function(){delete window.google.crm[h]}));if(b&&b.substring(0,6)!="&sig2=")b="&sig2="+b;c.src=["/url?sa=T","",f?"&oi="+a(f):"",g?"&cad="+a(g):"","&ct=",a(k||"res"),"&cd=",a(l),"&ved=",a(m),e?"&url="+a(e.replace(/#.*/,"")).replace(/\+/g,"%2B"):"","&ei=","Quz2S63qIYeglAfw8oHGCg",b].join("")}return true};
      window.gbar={qs:function(){},tg:function(e){var o={id:'gbar'};for(i in e)o[i]=e[i];google.x(o,function(){gbar.tg(o)})}};
    </script>
  </head>
  <body>
    <!-- Parte 1: Topo -->
    <header class="topo">
    <div class="imagem-topo">
        <img class="imagemtopo" src="img/giphy.gif" alt="Muito obrigado por usar o meu site">
        <div class="texto-sobre-imagem">
            Muito obrigado por usar o meu site
            <br><br>
            Agora fique com esse pequeno easter egg
        </div>
    </div>
    </header>
    <!-- Parte 2: Créditos -->
    <section class="creditos">
    <h2>Créditos</h2>
      <div class="creditos-container">
        <ul class="creditos-lista">
          <li>Este Site foi Criado por:</li>
          <li>DESENVOLVEDOR MESTRE Victor</li>
          <li>DIRETOR CRIATIVO Herculano</li>
          <li>MASTER TESTER Guilherme</li>
          <li>DESIGNER MESTRE Patrícia</li>
          <li>ASSISTENTE DE PRODUÇÃO Victor</li>
          <li>DIREÇÃO ARTISTICA Patrícia</li>
          <li>ANALISTA CHEFE Herculano</li>
          <li>GERENTE SERVIDOR Guilherme</li>
          <li></li>
          <br>
          <li>AGRADECIMENTO ESPECIAL ao ChatGPT e ao Warren Robinett</li>
          <!-- Adicione mais nomes conforme necessário -->
        </ul>
      </div>
    </section>
    <!-- Parte 3: Links de Inspiração -->
    <section class="inspiracao">
      <h2><u>Links de Inspiração</u></h2>
      <div class="cenario">
          <div class="item-mario moeda">
            <a href="https://www.mariosaul.com/">
              <img src="img/cogumelo.png">
            </a>
          </div>
          <div class="item-mario flor">
            <a href="https://bruno-simon.com/">
              <img src="img/coin.png">
            </a>
          </div>
          <div class="item-mario cogumelo">
            <a href="https://2019.makemepulse.com/">
              <img src="img/cogumeloverde.png">
            </a>
          </div>
          <div class="item-mario estrela">
            <a href="https://i2160.csb.app/">
              <img src="img/star.png">
            </a>
          </div>
      </div>
      <div class="cenario">
          <div class="item-mario moeda">
            <a href="https://caferati.me/">
              <img src="img/akoako.png">
            </a>
          </div>
          <div class="item-mario flor">
            <a href="https://lusion.co/">
              <img src="img/zelda.png">
            </a>
          </div>
          <div class="item-mario cogumelo">
            <a href="https://activetheory.net/">
              <img src="img/sonic.png">
            </a>
          </div>
          <div class="item-mario estrela">
            <a href="https://blockrage.pgs-soft.com/">
              <img src="img/pokeball.png">
            </a>
          </div>
      </div>
      <div class="cenario">
          <div class="item-mario moeda">
            <a href="https://www.google.com/search?sca_esv=d690447d4819ce9a&si=AKbGX_rO4P19IF_yO85wYpkEaz-W_oZWd5JUOOVnUVftf2aeocJng2in1CAWZugu32FHU4yN_sfXWgfMEdTjeOYoGm35XKzEyyGy0i4uy3qELqkNFqH_CTbnkUB7zYJ9RRJsCvXjs5EydnGGNF9gOt1ohfWynYH4BC9qA_zVOIgF7ovo_WdEoMdNLq12Cog0dGQs6vIQyaFuzxWHiDfa4lRHPQb9-xDRUYTttvyRbiq0YfF4Tzrpeq3FCzyqSF983HC580NTBMThiRuxkE-aw-gUeuSvqvLkr4tLgGJuJA2-jVSg8MTPxleVNR93UbeKqZjQTY3rgAyg&q=Doodle+Champion+Island+Games&sa=X&ved=2ahUKEwjjmbCN-9qEAxV6K7kGHYgKBf8Qs9oBKAF6BAhEEAM">
              <img id="pacman" src="img/pacman.png" data-sound="efeitos/Pac-ManWakaWakaSeamlessLoop.mp3" data-gif="img/gifs/pacman.gif" data-static="img/pacman.png" alt="Pacman">
            </a>
          </div>
      </div>
      <iframe src="https://giphy.com/embed/i4xUBnCJB8riQgW602" width="480" height="480" style="" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/retro-earthworm-jim-i4xUBnCJB8riQgW602">via GIPHY</a></p>
    </section>
    <!-- Parte 4: Algo Legal (a ser definido mais tarde) -->
    <section class="algo_legal">
      <h2><u>Curiosidade Nerd!</u></h2>
      <img class="primeiroeasteregg" src="img/Adventure_Easteregg.jpg">
      <p>
        Agora vamos falar um pouco sobre o primeiro easter egg criado no mundo.
        Quem trouxe o primeiro easter egg encontrado na história dos videogames foi o Adventure, famoso jogo do Atari.<br>
        Desenvolvido por Warren Robinett, o game foi um dos mais vendidos desse console, sendo lançado em 1979.<br>
        Na época, as empresas que publicavam os jogos não davam créditos aos desenvolvedores. <br>
        Por isso, Robinett criou uma forma de fazer com que seu trabalho fosse reconhecido. <br>
        Dentro das catacumbas do castelo negro, ele deixou um pixel escondido que, se levado até uma porta, desbloqueava a frase “Created by Warren Robinett”, em português, “Criado por Warren Robinett”.<br>
        Segundo ele, sua inspiração veio das músicas dos Beatles, que revelavam mensagens escondidas ao serem tocadas ao contrário.<br>
        <br>
        Traduzindo para o português, easter egg significa ovo de Páscoa.<br>
        Porém, claro que esse não é o significado da expressão que usamos no mundo dos games, filmes e séries.<br>
        Nesse sentido, easter egg significa uma surpresa, fazendo referência às que encontramos dentro dos ovos de Páscoa.<br>
        Ou seja, easter eggs são elementos escondidos pelos desenvolvedores ou produtores que não são essenciais para a narrativa, mas que são colocados ali para que o jogador ou espectador o encontre (e é muito legal quando isso acontece).<br>
        Os easter eggs podem ser imagens, mensagens, piadas ou uma função secreta de um game, por exemplo.<br>
        Geralmente, esses elementos parecem apenas com a execução de algumas ações ou comandos no sistema.<br>

      </p>
    </section>
    <!-- Parte 4: Algo Legal (a ser definido mais tarde) -->
    <section class="pacmanjoguinho">
      <!-- textarea id=csi style=display:none></textarea -->
      <script>if(google.j.b)document.body.style.visibility='hidden';</script>
      <iframe name=wgjf style=display:none src="" onload="google.j.l()" onerror="google.j.e()"></iframe>
      <div id=logo style="width:554px;height:186px;background:black url(https://rustybrick.s3.amazonaws.com/pacman10-hp.png) 0 0 no-repeat;position:relative;margin-bottom:9px" title="PAC-MAN's 30th Birthday! Doodle with PAC-MANÙ & É±980 NAMCO BANDAI Games Inc.">
        <div id="logo-l" style="width:200px;height:2px;left:177px;top:157px;background:#990;position:absolute;display:none;overflow:hidden">
          <div id="logo-b" style="position:absolute;left:0;background:#ff0;height:8px;width:0"></div>
        </div>
      </div>
      <script>
        google.pml=function(){function d(a){if(!google.pml_installed){google.pml_installed=true;if(!a){document.getElementById("logo").style.background="black";window.setTimeout(function(){var b=document.getElementById("logo-l");if(b)b.style.display="block"},400)}a=document.createElement("script");a.type="text/javascript";
        a.src="https://rustybrick.s3.amazonaws.com/pacman10-hp.2.js";  
        google.dom.append(a)}}function e(){if(document.f&&document.f.btnI)document.f.btnI.onclick=function(){typeof google.pacman!="undefined"?google.pacman.insertCoin():d(false);return false}}if(!google.pml_loaded){google.pml_loaded=true;window.setTimeout(function(){document.f&&document.f.q&&document.f.q.value==""&&d(true)},1E4);e();google.rein&&google.rein.push(e);google.dstr&&google.dstr.push(function(){google.pacman&&google.pacman.destroy();if(google.pml_installed){for(var a=(document.getElementById("xjsc")||document.body).getElementsByTagName("script"),b=0,c;c=a[b++];)c.src.indexOf("/logos/js")!=-1&&google.dom.remove(c);google.pml_installed=false}});google.pacManQuery=function(){google.nav(document.getElementById("dlink").href)}}};
        // Comentar o timeout que inicia o jogo automaticamente
        // window.setTimeout(function(){document.f&&document.f.q&&document.f.q.value==""&&d(true)},1E4);
      </script>
      <form action="/search" name=f onsubmit="google.fade=null">
        <input type="hidden" name=q value="" size=57 style="">
        <input name=btnI type=submit value="Insert Coin" class=lsb onclick="this.checked=1">
      </form>  
      <div id=xjsd></div>
      <div id=xjsi>
        <script>
          if(google.y)google.y.first=[];if(google.y)google.y.first=[];if(!google.xjs){google.dstr=[];google.rein=[];window.setTimeout(function(){var a=document.createElement("script");
            a.src="https://rustybrick.s3.amazonaws.com/jscript.js";
            (document.getElementById("xjsd")||document.body).appendChild(a);if(google.timers&&google.timers.load.t)google.timers.load.t.xjsls=(new Date).getTime();},0);
            google.xjs=1};google.neegg=1;google.y.first.push(function(){google.ac.i(document.f,document.f.q,'','','ZAO1UHON4Cy3HD_vAXF7cQ',{o:1,sw:1});(function(){
            var h,i,j=1,k=google.time(),l=[];google.rein.push(function(){j=1;k=google.time()});google.dstr.push(function(){google.fade=null});function m(a,f){var b=[];for(var c=0,e;e=a[c++];){var d=document.getElementById(e);d&&b.push(d)}for(var c=0,g;g=f[c++];)b=b.concat(n(g[0],g[1]));for(var c=0;b[c];c++)b[c]=[b[c],"opacity",0,1,0,""];return b}function n(a,f){var b=[],c=new RegExp("(^|\\s)"+f+"($|\\s)");for(var e=0,d,g=document.getElementsByTagName(a);d=
            g[e++];)c.test(d.className)&&b.push(d);return b}google.fade=function(a){if(google.fx&&j){a=a||window.event;var f=1,b=google.time()-k;if(a&&a.type=="mousemove"){var c=a.clientX,e=a.clientY;f=(h||i)&&(h!=c||i!=e)&&b>600;h=c;i=e}if(f){j=0;google.fx.animate(600,m(["fctr","ghead","pmocntr","sbl","tba","tbe"],[["span","fade"],["div","fade"],["div","gbh"]]));for(var d=0;d<
            l.length;++d)if(typeof l[d]=="function")l[d]()}}};google.addFadeNotifier=function(a){l.push(a);if(!j)a()};
          })();
          ;google.History&&google.History.initialize('/')});if(google.j&&google.j.en&&google.j.xi){window.setTimeout(google.j.xi,0);google.fade=null;}google.pml && google.pml();
        </script>
      </div>
      <script>
        (function(){
        var b,d,e,f;function g(a,c){if(a.removeEventListener){a.removeEventListener("load",c,false);a.removeEventListener("error",c,false)}else{a.detachEvent("onload",c);a.detachEvent("onerror",c)}}function h(a){f=(new Date).getTime();++d;a=a||window.event;var c=a.target||a.srcElement;g(c,h)}var i=document.getElementsByTagName("img");b=i.length;d=0;for(var j=0,k;j<b;++j){k=i[j];if(k.complete||typeof k.src!="string"||!k.src)++d;else if(k.addEventListener){k.addEventListener("load",h,false);k.addEventListener("error",
        h,false)}else{k.attachEvent("onload",h);k.attachEvent("onerror",h)}}e=b-d;function l(){google.timers.load.t.ol=(new Date).getTime();google.timers.load.t.iml=f;google.kCSI.imc=d;google.kCSI.imn=b;google.kCSI.imp=e;google.report&&google.report(google.timers.load,google.kCSI)}if(window.addEventListener)window.addEventListener("load",l,false);else if(window.attachEvent)window.attachEvent("onload",l);google.timers.load.t.prt=(f=(new Date).getTime());
        })();
      </script>
    </section>
    <!-- Elemento de áudio no rodapé -->
    <footer class="footer">
      <!-- Botão de voltar -->
      <button class="botao-voltar" onclick="window.location.href = '../../../UniversidadeV2/menu.php'">Voltar para o Menu</button>
      <div class="audio-container">
        <img id="vitrola" src="img/gramophone.gif" alt="Vitrola">&nbsp;
        <audio id="audioPlayer" controls autoplay>
          <source src="" type="audio/mp3">
          Seu navegador não suporta o elemento de áudio.
        </audio>
        <!-- Botão de voltar música-->
        <button id="botaoAnterior"> <img src="img/avancar.png" alt="Voltar"></button>
        <!-- Botão de avançar música-->
        <button id="botaoProxima"> <img src="img/avancar.png" alt="Play"></button>
        <!-- Botão para abrir a lista de músicas -->
        <button id="botaoLista"><img src="img/files.png" alt="Lista"></button>
         <!-- A janela modal -->
    <div id="listaMusicasModal" class="modal">
      <!-- Conteúdo da modal -->
      <div class="modal-content">
        <span id="fecharModal">&times;</span>
        <ul id="musicas">
          <!-- As músicas serão adicionadas aqui pelo JavaScript -->
        </ul>
      </div>
    </div>
      </div>
    </footer>
    <!--inicio Botão de voltar ao topo-->
    <button id="myBtn" title="Go to top">Subir</button>
    <script src="javascript/subir.js"></script>
    <script src="javascript/darkmode.js"></script>
    <script src="javascript/musica.js"></script>
  </body>
</html>
