<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="say something.."
                class="col-span-5 outline-none p-1 border border-t border-solid border-black"
            />
            <button
                class="place-self-center bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white"
                @click="sendMessage()"
            >
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["room"],
    data() {
        return {
            message: "",
        };
    },
    methods: {
        sendMessage() {
            if (!this.message == " ") {
                axios
                    .post("/chat/room/" + this.room.id + "/message", {
                        message: this.message,
                    })
                    .then((res) => {
                        if (res.status == 201) {
                            this.message = "";
                            this.$emit("messageSent");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
    },
};
</script>

<style></style>
