$(() => {
    var scripts = [
        "editorjs@latest",
        "header@latest",
        "list@latest",
        "delimiter@latest",
        "image@latest",
        "quote@latest",
        "marker@latest",
        "link@latest",
        "warning@latest"
    ];
    $.ajaxSetup({
        cache: true,
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		}
    });
    $.getMultiScripts(scripts, "https://cdn.jsdelivr.net/npm/@editorjs/")
    .done(() => {
        $.ajaxSetup({
            cache: false
        });
        initTooltips();
        window.setTimeout(() => {
			/*
            $.get("/approj/pages/get_content.php", {id: window.page_id}, (data) => {
                data = JSON.parse(data);
                init_editorjs(data);
            });
			*/
			data = JSON.parse($("#post-content").text());
            init_editorjs(data);
        }, 10);
    });
});

function init_editorjs(text) {
    const editor = new EditorJS({
        holder: "editorjs",
        
        onReady: () => {
            $("#loader").fadeOut("slow", function() {
                $(this).remove();
                $("#editorjs").removeClass("d-none");
                $("#toolbar").css("opacity", "1");
                $("#editorjs .codex-editor .codex-editor__redactor .ce-block .ce-block__content .ce-paragraph").focus();
            });
        },
        
        onChange: () => {
            save_changes(editor);
        },

        tools: { 
            header: Header,
            
            list: {
                class: List,
                inlineToolbar: true,
            },
            
            delimiter: Delimiter,
            
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: "/uploads/file",
                        byUrl: "/uploads/url",
                    }
                },
                captionPlaceholder: "Légende...",
                buttonContent: "Sélectionnez une image"
            },
            
            quote: {
                class: Quote,
                inlineToolbar: true,
                shortcut: 'CMD+SHIFT+O',
                config: {
                    quotePlaceholder: "Entrez une citation",
                    captionPlaceholder: "Auteur de la citation",
                },
            },
            
            Marker: {
                class: Marker,
                shortcut: 'CMD+SHIFT+M',
            },
            
            linkTool: {
                class: LinkTool,
                config: {
                    endpoint: "", // TODO: Add this
                }
            },
            
            warning: {
                class: Warning,
                inlineToolbar: true,
                shortcut: 'CMD+SHIFT+W',
                config: {
                    titlePlaceholder: 'Titre',
                    messagePlaceholder: 'Message',
                },
            },
        },
        
        i18n: {
            messages: {
                
                ui: {
                    "blockTunes": {
                        "toggler": {
                            "Click to tune": "Cliquez pour régler",
                            "or drag to move": "ou faites glisser pour déplacer"
                        },
                    },
                    "inlineToolbar": {
                        "converter": {
                            "Convert to": "Convertir en"
                        }
                    },
                    "toolbar": {
                        "toolbox": {
                            "Add": "Ajouter"
                        }
                    }
                },
                
                toolNames: {
                    "Text": "Texte",
                    "Heading": "En-tête",
                    "List": "Liste",
                    "Warning": "Avertissement",
                    "Checklist": "Checklist",
                    "Quote": "Citation",
                    "Code": "Code",
                    "Delimiter": "Délimiteur",
                    "Raw HTML": "HTML pur",
                    "Table": "Table",
                    "Link": "Lien",
                    "Marker": "Surligneur",
                    "Bold": "Gras",
                    "Italic": "Italique",
                    "InlineCode": "Code en ligne"
                },
                
                tools: {
                    "warning": {
                        "Title": "Titre",
                        "Message": "Message",
                    },
                    
                    "link": {
                        "Add a link": "Ajouter un lien"
                    },
                    
                    "stub": {
                        "The block can not be displayed correctly.": "Le bloc ne peut pas être affiché correctement."
                    },
                    
                    "list": {
                        "Ordered": "Ordonné",
                        "Unordered": "Désordonné"
                    }
                },
            
                blockTunes: {
                    "delete": {
                        "Delete": "Effacer"
                    },
                    "moveUp": {
                        "Move up": "Déplacer vers le haut"
                    },
                    "moveDown": {
                        "Move down": "Déplacer vers le bas"
                    }
                },
                
            },
        },
        
        data: text,
    });
}

function save_changes(editor) {
    editor.save().then((output) => {
        $("#toolbar .save-btn i")
            .fadeOut(0, function() {
                $(this)
                    .replaceWith($("<i/>").addClass("bi-arrow-repeat save-arrow"))
            });
        $("#toolbar .save-btn span").html("");
        title = $("#post-title-input").val();
        output = JSON.stringify(output);
        $.post({
            url: $("#editorjs").attr("data-post-route"),
            data: {
				title: title,
				content: output,
				category: "CSS",
				_method: "PATCH"
            },
			error: (data) => {
				console.log(data.responseText);
			}
        }).done((data) => {
            /*window.history.replaceState({}, "", `/posts/${data}/edit`);
            $("#editorjs").attr("data-post-route", `/posts/${data}`);*/
            var today = new Date();
            var hour = today.getHours();
            var minutes = today.getMinutes().toString().padStart(2, "0");
            $("#toolbar .save-btn i")
                .fadeOut(0, function() {
                    $(this)
                        .replaceWith($("<i/>").addClass("bi-cloud-check"))
                });
            $("#toolbar .save-btn span").html(`${hour}:${minutes}`);
        });
    }).catch((error) => {
        console.log("Saving failed: ", error);
    });
}

function initTooltips() {
    $("[data-toggle=tooltip]").each(function() {
        var tooltip = new mdb.Tooltip(this, {
            boundary: "window",
            delay: {"show": 1000, "hide": 100 }
        });
    });
}

$.getMultiScripts = (arr, path) => {
    var _arr = $.map(arr, (scr) => {
        console.log(`Getting script ${path + scr}`);
        return $.getScript((path||"") + scr );
    });
    _arr.push($.Deferred((deferred) => {
        $(deferred.resolve);
    }));
    return $.when.apply($, _arr);
};