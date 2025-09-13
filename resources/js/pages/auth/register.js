import { validateStepOne } from './validation.js';
import { handlePhotoUpload } from './photoUpload.js';

window.registrationForm = function () {
    return {
        step: 1,
        file: null,
        hasFile: false,
        photoStyle: '',

        nextStep() {
            if (validateStepOne(this.$el)) {
                this.step = 2;
            }
        },

        triggerFileInput() {
            this.$el.querySelector('#profile-photo')?.click();
        },

        fileChanged(event) {
            handlePhotoUpload(event, ({ file, style }) => {
                this.file = file;
                this.hasFile = true;
                this.photoStyle = style;
            });
        }
    };
};
