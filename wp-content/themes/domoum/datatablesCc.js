var editorCc; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editorCc = new $.fn.dataTable.Editor( {
        ajax: "/wp-content/themes/domoum/datatablesCc.php",
        table: "#coups",
        fields: [ {
                label: "Id",
                name: "id"
            }, {
                label: "Titre",
                name: "title"
            }, {
                label: "Url",
                name: "link"
            }, {
                label: "Coordonnées",
                name: "telephone"
            }, {
                label: "Email envoyé",
                name: "email"
            }, {
                label: "Réponse",
                name: "email_answer"
            }, {
                label: "Appel fait",
                name: "call_bool"
            }, {
                label: "Réponse",
                name: "call_answer"
            }, {
                label: "Visite",
                name: "start_date",
                type: "datetime"
            }, {
                label: "Commentaire",
                name: "commentary"
            }
        ]
    } );
 
   	var tableCc = $('#coups').DataTable( {
        dom: "Bfrtip",
        ajax: "/wp-content/themes/domoum/datatablesCc.php",
        language: {
                "url": "/wp-content/themes/domoum/french.json"
            },
        buttons: [
		   'Modifier', 'Supprimer'
		],
        columns: [
        	{ data: "id" },
            { data: "title" },
            { data: "link" },
            { data: "telephone" },
            { data: "email" },
            { data: "email_answer" },
            { data: "call_bool" },
            { data: "call_answer"},
            { data: "start_date"},
			{ data: "commentary"}

        ],
        select: true,
        buttons: [
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = tableCc.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );


    tableCc.on( 'order.dt search.dt', function () {
        tableCc.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
