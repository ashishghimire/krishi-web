$('document').ready(function () {
    tinymce.init({
        selector: '.maths-editor',
        menubar: false,
        toolbar: 'tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
        mode: "textareas",
        force_br_newlines: false,
        force_p_newlines: false,
        forced_root_block: '',
        plugins: 'tiny_mce_wiris',
        branding: false,
        resize: false,
        statusbar: false
    });

});
