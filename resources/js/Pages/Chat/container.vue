<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    @roomChange="setRoom"
                />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="currentRoonMessages" />
                    <input-message
                        @messageSent="getRoomMessages"
                        :room="currentRoom"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import messageContainer from "./messageContainer.vue";
import inputMessage from "./inputMessage.vue";
import ChatRoomSelection from "./chatRoomSelection.vue";
export default {
    components: {
        AppLayout,
        messageContainer,
        inputMessage,
        ChatRoomSelection,
    },
    data() {
        return {
            chatRooms: [],
            currentRoom: [],
            currentRoonMessages: [],
        };
    },
    watch: {
        currentRoom(val, oldVal) {
            if (oldVal.id) {
                this.disconnect(oldVal);
            }
            this.connect();
        },
    },
    methods: {
        connect() {
            if (this.currentRoom.id) {
                let vm = this;
                this.getRoomMessages();
                window.Echo.private("chat." + this.currentRoom.id).listen(
                    "NewChatMessage",
                    () => {
                        vm.getRoomMessages();
                    }
                );
            }
        },
        disconnect() {
            window.leave("chat." + room.id);
        },
        getRooms() {
            axios
                .get("/chat/rooms")
                .then((res) => {
                    this.chatRooms = res.data;
                    this.setRoom(res.data[0]);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        setRoom(room) {
            console.log(room);
            this.currentRoom = room;
        },
        getRoomMessages() {
            axios
                .get("/chat/room/" + this.currentRoom.id + "/messages")
                .then((res) => {
                    this.currentRoonMessages = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    created() {
        this.getRooms();
    },
};
</script>
