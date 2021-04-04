<template>
    <div class="h-96 w-full">
        <div class="h-full flex flex-col-reverse overflow-scroll">
            <div v-for="(message, index) in messages" :key="index">
                <single-message :message="message" />
            </div>
        </div>
    </div>
</template>

<script>
import singleMessage from "./singleMessage.vue";
export default {
    components: { singleMessage },
    props: ["messages"],
};
</script>

<style></style>
