var myDropzone = new FileDropzone({
        target: '.box',
        fileHoverClass: 'entered',
        clickable: false,
        multiple: true,
        forceReplace: false,
        unique: true,
        paramName: 'file',
        accept: 'application/pdf,image/jpg,image/jpeg',
        onChange: function () {
          var files = this.getFiles();
          var elem = this.element.find('.files');
          elem.empty();
          files.forEach(function (item) {
            elem.append('<div class="file-name" data-id="' + item.id + '">' + item.name + '</div>')
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
