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
		/*headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		}*/
    });
    XMLHttpRequest.prototype.realSend = XMLHttpRequest.prototype.send;
    XMLHttpRequest.prototype.send = function(data) {
        this.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr("content"));
        this.realSend(data);
    };
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
            initMenu();
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
                        byUrl: "/uploads/url", // TODO: Add upload by URL
                    }
                },
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
                    endpoint: "/linkdata",
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
    window.editorJS = editor;
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
				category: "Post",
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

function initMenu() {
    $("#changeImageButton").on("click", () => {
        var modal = new mdb.Modal($("#imageChangeModal")[0])
        modal.show();
        var modalId = $("#imageChangeModal");
        var uploader = new ss.SimpleUpload({
            url: "/uploads/file",
            button: modalId.find(".file-input-btn")[0],
            name: "image",
            responseType: "json",
            allowedExtensions: ["jpg", "jpeg", "png", "gif"],
            maxSize: 2000,
            disabledClass: "disabled",
            onSubmit: function(filename, extension) {
                modalId.find(".progress").removeClass("d-none");
                this.setFileSizeBox(modalId.find(".file-size-box")[0]);
                this.setProgressBar(modalId.find(".progress-bar")[0]);
            },         
            onComplete: function(filename, response) {
                console.log("Uploading image...");
                modalId.find(".progress").addClass("d-none");
                if (!response) {
                    window.snackbar("Upload failed", "bg-danger");
                }
                else {
                    var url = response["file"]["url"];
                    
                    window.editorJS.save().then((output) => {
                        title = $("#post-title-input").val();
                        output = JSON.stringify(output);
                        $.post({
                            url: $("#editorjs").attr("data-post-route"),
                            data: {
                                title: title,
                                content: output,
                                category: "Post",
                                image: url,
                                _method: "PATCH"
                            },
                            error: (data) => {
                                console.log(data.responseText);
                            }
                        }).done((data) => {
                            window.snackbar("Image changed successfully");
                        });
                    }).catch((error) => {
                        console.log("Saving failed: ", error);
                    });
                }
            }
        });
    });

    $("#previewButton").on("click", function() {
        var modal = new mdb.Modal($("#previewModal")[0])
        modal.show()
        $("#previewModal iframe")[0].contentWindow.location.reload(true)
        $("#previewModal iframe").on("load", function() {
                $("#previewModal .loading-spinner").css("display", "none");
                $(this).css("display", "block");
            });
    });
    $("#previewModal .btn-close").on("click", () => {
        $("#previewModal .loading-spinner").css("display", "block");
        $("#previewModal iframe").css("display", "none");
    })

    $("#publishButton").on("click", function() {
        window.confirmModal("Are you sure you want to publish this post?<br/>This is an irreversible action!", () => {}, () => {
            $.post({
                url: $("#editorjs").attr("data-publish-route"),
            }).done((data) => {
                $("#publishButton")
                    .prop("disabled", true)
                    .text("Published!");
                window.snackbar("Sucessfully published post");
            }).catch((error) => {
                window.snackbar("There was an error in publishing the post", "bg-danger")
                console.log("Publishing failed: ", error);
            });
        })
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