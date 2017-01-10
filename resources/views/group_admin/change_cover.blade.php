@extends('group_admin.layouts.index')

@section('content')
<div class="coverImages">
    <div class="images">
        <h3 style="color: #ff7e00;">Cover images</h3>
        <p>Upload images only: width:1920px, height:800px</p>

        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
        <div class="currentImage">
            <img  src="http://restaurants.dev/images/coverImages/cover11.png" alt="">
            <div class="removeImage">Remove</div>
        </div>
    </div>
    <form id="fileupload" action="{{url('admin/place/add_cover')}}" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                                                                <i class="glyphicon glyphicon-plus"></i>
                                                                <span>Add files...</span>
                                                                <input type="file" name="files[]" multiple>
                                                            </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>

                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
</div>
@endsection


@section('styles')

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="/admin/plugins/bootstrap-select/bootstrap-select.min.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2-metronic.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/plugins/jquery-multi-select/css/multi-select.css"/>

    <!-- Bootstrap styles -->
    {{--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">--}}
    <!-- Generic page styles -->
    <link rel="stylesheet" href="/admin/css/fileUpload/css/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>


@endsection
@section('scripts')

    <script type="text/javascript" src="/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/admin/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="/admin/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/admin/scripts/core/app.js"></script>
    <script src="/admin/scripts/custom/components-dropdowns.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        //var services = ["red", "green", "blue", "yellow", "pink"];

        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();
            ComponentsDropdowns.init();
        });
    </script>
    <script src="/admin/scripts/myCustom/editPage.js"></script>

    <script id="template-upload" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                        <td>
                            <span class="preview"></span>
                        </td>
                        <td>
                            <p class="name">{%=file.name%}</p>
                            <strong class="error text-danger"></strong>
                        </td>
                        <td>
                            <p class="size">Processing...</p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                        </td>
                        <td>
                            {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn btn-primary start" disabled>
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start</span>
                                </button>
                            {% } %}
                            {% if (!i) { %}
                                <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                </button>
                            {% } %}
                        </td>
                    </tr>
                {% } %}
                </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                        <td>
                            <span class="preview">
                                {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img width=80 height=auto src="{%=file.thumbnailUrl%}"></a>
                                {% } %}
                            </span>
                        </td>
                        <td>
                            <p class="name">
                                {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                {% } else { %}
                                    <span>{%=file.name%}</span>
                                {% } %}
                            </p>
                            {% if (file.error) { %}
                                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                            {% } %}
                        </td>
                        <td>
                            <span class="size">{%=o.formatFileSize(file.size)%}</span>
                        </td>
                        <td>
                            {% if (file.deleteUrl) { %}
                                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                </button>

                            {% } else { %}
                                <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                </button>
                            {% } %}
                        </td>
                    </tr>
                {% } %}
    </script>

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/admin/scripts/fileUpload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/admin/scripts/fileUpload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/admin/scripts/fileUpload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/admin/scripts/fileUpload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/admin/scripts/fileUpload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="/admin/scripts/fileUpload/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="/admin/scripts/fileUpload/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="/admin/scripts/fileUpload/js/main.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="/admin/scripts/fileUpload/js/cors/jquery.xdr-transport.js"></script>
@endsection
