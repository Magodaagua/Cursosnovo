function limparFiltro() {
    // Obtém o valor do input 'categoria'
    const categoria = document.getElementById('categoria').value;
    
    // Define o valor 'default' no input 'categoria'
    document.getElementById('categoria').value = 'default';
    
    // Cria a URL com o novo valor de 'categoria'
    const url = `comunidade.php?Dep=${categoria}`;
    
    // Redireciona para a nova URL
    window.location.href = url;
    // Aqui você pode adicionar lógica adicional se necessário após limpar o filtro
}
