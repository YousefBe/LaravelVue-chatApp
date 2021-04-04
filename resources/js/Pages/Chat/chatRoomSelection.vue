<template>
    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">{{ selected.name }} chat</div>
        <div class="">
            <select
                v-model="selected"
                @change="$emit('roomChange', selected)"
                class="float-right"
            >
                <option
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room"
                >
                    {{ room.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.selected = this.currentRoom;
    },
    props: ["rooms", "currentRoom"],
    data() {
        return {
            selected: "",
        };
    },
};
</script>

<style></style>
