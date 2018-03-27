(function () {

    /**
     * Task Form.
     */
    if (document.getElementById('taskPreview')) {
        var TaskForm = {
            username: document.getElementById('taskFormUsername'),
            email: document.getElementById('taskFormEmail'),
            text: document.getElementById('taskFormText'),
            image: document.getElementById('taskFormImage'),
            status: document.getElementById('taskFormStatus'),
            btnPreview: document.getElementById('taskFormBtnPreview'),
            previewId: document.getElementById('taskPreviewId'),
            previewUsername: document.getElementById('taskPreviewUsername'),
            previewEmail: document.getElementById('taskPreviewEmail'),
            previewText: document.getElementById('taskPreviewText'),
            previewImage: document.getElementById('taskPreviewImage'),
            previewStatus: document.getElementById('taskPreviewStatus'),
            init: function () {
                this.btnPreview.addEventListener('click', function () {
                    this.preview();
                }.bind(this));
            },
            previewFile: function (input, previewElement, width) {
                if (input.files && input.files[0]) {
                    var fileReader = new FileReader();

                    fileReader.onload = function (e) {
                        previewElement.style.width = width;
                        previewElement.src = e.target.result;
                    };

                    fileReader.readAsDataURL(input.files[0]);
                }
            },
            preview: function () {
                this.previewId.innerText = '1';
                this.previewUsername.innerText = this.username.value;
                this.previewEmail.innerText = this.email.value;
                this.previewText.innerText = this.text.value;
                this.previewFile(this.image, this.previewImage, '320px');
                if (this.status) {
                    this.previewStatus.innerText = this.status.checked ? 'Done' : 'Not Done';
                }
            }
        };
        TaskForm.init();
    }

})();
