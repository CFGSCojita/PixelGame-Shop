
// Cream un objecte per a cada filtre i empram les funcions de jQuery per a aplicar les preferències emmagatzemades a localStorage.
const filtres = {
    'grisos': 'grayscale(100%)',
    'contrast-fosc': 'contrast(150%) brightness(50%)',
    'contrast-clar': 'contrast(150%) brightness(150%)',
    'saturacio-alta': 'saturate(300%)',
    'saturacio-baixa': 'saturate(30%)'
};

// Cream una funció per a aplicar les preferències d'accessibilitat emmagatzemades a localStorage a l'element <html>.
function aplicarPreferencies() {
    $('html').css({
        'filter': filtres[localStorage.getItem('filtre')] || '',
        'font-size': (localStorage.getItem('mida') || '1') + 'rem',
        'line-height': localStorage.getItem('interlineat') || '1.5',
        'word-spacing': (localStorage.getItem('espai-paraules') || '0') + 'rem',
        'letter-spacing': (localStorage.getItem('espai-lletres') || '0') + 'rem'
    });
}

// Cream una funció per a marcar el filtre actiu a la interfície d'accessibilitat.
function marcarFiltreActiu() {
    const filtreActiu = localStorage.getItem('filtre') || 'cap';
    $('[data-filtre]').removeClass('actiu');
    $('[data-filtre="' + filtreActiu + '"]').addClass('actiu');
}

// Empram delegació d'esdeveniments per a gestionar els canvis en els filtres i les preferències d'accessibilitat, així com el restabliment de les preferències.
$(document).ready(function () {

    aplicarPreferencies(); // Aplicam les preferències emmagatzemades a localStorage en carregar la pàgina.

    // Si no existeix el botó de restabliment, no cal gestionar les preferències d'accessibilitat.
    if (!$('#btn-reset').length) {
        return;
    }

    marcarFiltreActiu(); // Marcam el filtre actiu en carregar la pàgina.

    // Carregam els valors dels controls de preferències d'accessibilitat des de localStorage.
    ['mida', 'interlineat', 'espai-paraules', 'espai-lletres'].forEach(id => {
        $('#' + id).val(localStorage.getItem(id));
    });

    // Gestionam els clics en els botons de filtre per a emmagatzemar la preferència i aplicar-la.
    $('[data-filtre]').click(function () {
        localStorage.setItem('filtre', $(this).data('filtre'));
        aplicarPreferencies();
        marcarFiltreActiu();
    });

    // Gestionam els canvis en els controls de preferències d'accessibilitat per a emmagatzemar les preferències i aplicar-les.
    $('input[type=range]').on('input', function () {
        localStorage.setItem($(this).attr('id'), $(this).val());
        aplicarPreferencies();
    });

    // Gestionam el clic en el botó de restabliment per a esborrar les preferències emmagatzemades i restablir les preferències per defecte.
    $('#btn-reset').click(function () {
        localStorage.clear();
        aplicarPreferencies();
        marcarFiltreActiu();
        ['mida', 'interlineat', 'espai-paraules', 'espai-lletres'].forEach(id => {
            $('#' + id).val($('#' + id).attr('value'));
        });
    });
});