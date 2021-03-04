var myDropzone = new FileDropzone({
        target: '.box',
        fileHoverClass: 'entered',
        clickable: false,
        multiple: true,
        forceReplace: false,
        unique: false,
        paramName: 'file',
        accept: 'application/pdf,image/jpg,image/jpeg',
        onChange: function () {
          var files     = this.getFiles();
          var elem      = this.element.find('.files');
          elem.empty();
          var totalSize = 0;

          files.forEach(function (item, index) {
            if (index >= 20){
                removeFile(item);
                notify("error", "Files cannot exceed 20!");
            } else {
                totalSize += item.size;
                if (totalSize > 50000000) {
                    notify("error", "`Total file size cannot exceed 50mb!");
                } else {
                    if (!checkFileSize(item, 50)) {
                        elem.append('<div class="file-name" data-id="' + item.id + '">'+ item.name + '<span class="la la-trash remove-dropped" onclick="removeFile('+ index +')"></span></div>');
                    }
                }
            }
          });
        },
        onEnter: function () {
          // console.log('enter')
        },
        onLeave: function () {
          // console.log('leave')
        },
        onHover: function () {
          // console.log('hover')
        },
        onDrop: function () {
          // console.log('drop')
        },
        onFolderFound: function (folders) {
          // console.log('' + folders.length + ' folders ignored. Change noFolder option to true to accept folders.')
        },
        onInvalid: function (files) {
          notify("error", "File not supported, only pdf or images supported!");
        },
        beforeAdd: function (files) {
            for (var i = 0, len = files.length; i < len; i++) {
                let file = files[i]
                file.id = new Date().getTime()
                if (/fuck/.test(file.name)) {
                  return false;
                }
              }
          return true;
        }
    });

function checkFileSize(item, max)
{
  size = FileDropzone.getFileSize(item, 'mb');
  if (size > max){
    notify('error', 'File Size cannot exceed '+max+'mb');
    myDropzone.removeFile(item);
    return true;
  }
  return false;
}

function removeFile(item)
{
    myDropzone.removeFile(item);
}

$(".wizard-step").on('click', function () {
    myDropzone.clearAll();
});

