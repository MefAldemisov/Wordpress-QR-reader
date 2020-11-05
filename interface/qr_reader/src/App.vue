<template>
    <div>
        <button v-if="!val" @click="upAction">{{ show ? "X" : text }}</button>
        <div>Если QR код не считывается, попробуйте обновить страницу</div>
        <div v-if="show">
            <div v-if="val">
                <div v-if="error" class="error" @click="reset">{{ error }}</div>
                <button v-if="!error" @click="redirect">
                    {{ redirect_text }}
                </button>
            </div>
            <div v-else class="limited">
                <qrcode-stream @decode="onDecode"></qrcode-stream>
            </div>
        </div>
    </div>
</template>

<script>
// import QrcodeStream from "vue-qrcode-reader";
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from "vue-qrcode-reader";
if (!settings) {
    settings = {
        btn_text: "Read QR",
        error: "$error_text",
        redirect_text: "$redirect_text",
    };
}

export default {
    name: "App",
    components: {
        QrcodeStream,
    },
    props: {
        text: {
            type: String,
            default: settings.btn_text,
        },
    },
    data() {
        return {
            show: false,
            val: "",
            error: "",
            redirect_text: settings.redirect_text,
        };
    },
    methods: {
        unhide() {
            this.show = true;
        },
        onDecode(decodedString) {
            this.val = decodedString;
        },
        redirect() {
            if (this.val.search("http") >= 0) {
                window.location.href = this.val;
            } else {
                this.error = settings.error;
            }
        },
        reset() {
            this.error = "";
            this.val = "";
        },
        resetAll() {
            this.reset();
            this.show = false;
        },
        upAction() {
            if (!this.show) {
                this.unhide();
            } else {
                this.resetAll();
            }
        },
    },
};
</script>
<style scoped>
div.limited {
    max-width: 80%;
    max-height: 300px;
    border: 2px solid black;
}
.error {
    border: 2px solid red;
    border-radius: 0.5rem;
    color: red;
    background-color: lightpink;
    padding: 0.5rem;
    display: inline-block;
}
</style>

