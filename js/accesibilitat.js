
// Cream un objecte amb els filtres CSS disponibles:
const filtres = {
    'grisos': 'grayscale(100%)',
    'contrast-fosc': 'contrast(150%) brightness(50%)',
    'contrast-clar': 'contrast(150%) brightness(150%)',
    'saturacio-alta': 'saturate(300%)',
    'saturacio-baixa': 'saturate(30%)'
};

// Cream una funció per aplicar les preferències emmagatzemades a l'estil de la pàgina:
function aplicarPreferencies() {
    $('html').css({
        'filter': filtres[localStorage.getItem('filtre')] || '',
        'font-size': (localStorage.getItem('mida') || '1') + 'rem',
        'line-height': localStorage.getItem('interlineat') || '1.5',
        'word-spacing': (localStorage.getItem('espai-paraules') || '0') + 'rem',
        'letter-spacing': (localStorage.getItem('espai-lletres') || '0') + 'rem'
    });
}

// Aplicam delegació d'esdeveniments quan el document està llest:
$(document).ready(function () {

    aplicarPreferencies(); // Aplicam les preferències emmagatzemades en carregar la pàgina.

    if (!$('#btn-reset').length) {
        return;
    }

    // Sincronitzem sliders
    ['mida', 'interlineat', 'espai-paraules', 'espai-lletres'].forEach(id => {
        $('#' + id).val(localStorage.getItem(id));
    });

    // Contrast
    $('[data-filtre]').click(function () {
        localStorage.setItem('filtre', $(this).data('filtre'));
        aplicarPreferencies();
    });

    // Sliders
    $('input[type=range]').on('input', function () {
        localStorage.setItem($(this).attr('id'), $(this).val());
        aplicarPreferencies();
    });

    // Reset
    $('#btn-reset').click(function () {
        localStorage.clear();
        aplicarPreferencies();
        ['mida', 'interlineat', 'espai-paraules', 'espai-lletres'].forEach(id => {
            $('#' + id).val($('#' + id).attr('value'));
        });
    });
});