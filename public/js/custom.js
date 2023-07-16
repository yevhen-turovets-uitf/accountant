function tinymce_init_callback(editor)
{
    editor.remove();
    editor = null;
    tinymce.init({
        selector: 'textarea.richTextBox',  // change this value according to your HTML
        plugins: 'link, image, code, table, lists',
        toolbar: 'styles | styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | anchor link image table | print | code',
        style_formats: [
            { title: 'Bold text', inline: 'b' },
            { title: 'Red text', inline: 'span', styles: {color: '#ff0000'} },
            { name: 'my-inline', title: 'My inline', inline: 'span', classes: [ 'my-inline' ] },
            { title: 'Comment', inline: 'span', classes: [ 'comment' ] },
        ],
        style_formats_merge: true
    });
}
