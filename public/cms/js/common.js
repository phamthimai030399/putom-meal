var lfm = function(id, type, options) {
  let button = document.getElementById(id);
  if(button){
    button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?types=' + type || 'Files', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
            var file_path = items.map(function (item) {
                return item.url;
            }).join(',');
            file_path = file_path.replace(/^.*\/\/[^\/]+/, '');
            // set the value of the desired input to image url
            target_input.value = file_path;
            target_input.dispatchEvent(new Event('change'));

            // clear previous preview
            target_preview.innerHtml = '';

            // set or change the preview image src
            items.forEach(function (item) {
                let img = document.createElement('img')
                img.setAttribute('style', 'height: 5rem')
                img.setAttribute('src', item.thumb_url)
                target_preview.appendChild(img);
            });
            if (document.getElementById("lbl_img")) {
              let lbl_img = document.getElementById('lbl_img');
              lbl_img.setAttribute('class', 'd-none');
            }
            
            // trigger change event
            target_preview.dispatchEvent(new Event('change'));
        };
    });
  }
};
var route_prefix = "/admin/laravel-filemanager";
lfm('lfm', 'Images', {prefix: route_prefix});
lfm('lfm2', 'Files', {prefix: route_prefix});
var editor_config = {
  path_absolute : "/",
  selector: 'textarea.content',
  relative_urls: false,
  height : 350,
  plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table directionality",
    "emoticons template paste textpattern"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
  file_picker_callback : function(callback, value, meta) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = editor_config.path_absolute + 'admin/laravel-filemanager?editor=' + meta.fieldname;
    if (meta.filetype == 'image') {
      cmsURL = cmsURL + "&types=Images";
    } else {
      cmsURL = cmsURL + "&types=Files";
    }

    tinyMCE.activeEditor.windowManager.openUrl({
      url : cmsURL,
      title : 'Filemanager',
      width : x * 0.8,
      height : y * 0.8,
      resizable : "yes",
      close_previous : "no",
      onMessage: (api, message) => {
        callback(message.content);
      }
    });
  }
};

tinymce.init(editor_config);

function deleteRecord(url) {
    swal({
      title: "Bạn xóa chắc muốn xóa bản ghi này ?",
      text: "Thực hiện việc xóa bản ghi.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, Tôi đồng ý!",
      cancelButtonText: "No, Hủy bỏ!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
  function(isConfirm){
    if (isConfirm) {
        //swal("Deleted!", "Bản ghi đã được xóa", "success");
        window.location.href = url;
    } else {
      swal("Cancelled", "Tôi không muốn xóa bản ghi này", "error");
    }
  });
}

function generate_slug_from_title(title) {
    let slug;
    slug = title.toLowerCase();
    slug = slug.replace(/\//mig, "-");
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    slug = slug.replace(/\s/g, "-");
    return slug;
}