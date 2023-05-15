<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const comment = ref('')
const replyToComment = ref('')
const activeReply = ref()

const props = defineProps(['comments', 'discussion_count']);

const showReply = (id) => {
    replyToComment.value = ''
    activeReply.value = id
}

const postComment = () => {
    router.post(`/posts/${1}/comment/`, {
        comment: comment.value,
    }, {preserveScroll: true})

    comment.value = ''
}

const userReply = (id) => {
    router.post(`/comments/${id}/reply`, {
        reply: replyToComment.value,
    }, {preserveScroll: true})

    activeReply.value = null
    replyToComment.value = ''
}
</script>

<template>
    <section class="bg-white py-8 lg:py-16">
        <div class="max-w-2xl mx-auto px-4">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Discussion ({{ props.discussion_count }})</h2>
            </div>

            <form class="mb-6">
                
                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                    <textarea
                        v-model="comment"
                        rows="6"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                        placeholder="Write a comment..." required></textarea>
                </div>
                <button 
                    @click.prevent="postComment"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800"
                    :disabled="comment.length < 1"
                >
                      
                        Post comment
                </button>

            </form>
            <article v-for="comment in props.comments" :key="comment.id" class="p-6 text-base bg-white rounded-lg">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 capitalize">{{comment.user?.name}}</p>
                        <p class="text-sm text-gray-600">{{ new Date(comment.created_at).toLocaleString() }}</p>
                    </div>
                </footer>

                <p class="text-gray-500">{{comment.body}}</p>

                <div class="flex items-center mt-4 space-x-4">
                    <button 
                        @click="showReply(comment.id)"
                        class="flex items-center text-sm text-gray-500 hover:underline">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Reply
                    </button>
                </div>

                <div 
                    v-if="activeReply === comment.id" 
                    class="flex justify-end py-2 px-4 mt-6 bg-white rounded-lg rounded-t-lg border-b border-gray-200"
                >

                    <input 
                    v-model="replyToComment"
                    class="w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                    placeholder="Add reply..."
                    required>

                    <div class="flex items-center pl-3">
                        <button 
                            @click="userReply(comment.id)"
                            class="flex items-center text-sm text-gray-500 hover:underline"
                            :disabled="replyToComment.length < 1"
                        >
                                Send
                            <svg class="mr-1 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.8160000000000001"></g><g id="SVGRepo_iconCarrier"> <path d="M20 12L4 4L6 12M20 12L4 20L6 12M20 12H6" stroke="#000000" stroke-width="0.384" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>
                    </div>
                </div>

                <article v-for="reply in comment.replies" :key="reply.id" class="p-6 mb-2 ml-6 lg:ml-12 text-base bg-white rounded-lg">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 capitalize">{{ reply.user?.name }}</p>
                            <p class="text-sm text-gray-600">{{ new Date(reply.created_at).toLocaleString() }}</p>
                        </div>
                    </footer>

                    <p class="text-gray-500">{{ reply.body }}</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <button 
                            @click="showReply(reply.id)"
                            class="flex items-center text-sm text-gray-500 hover:underline"
                        >
                                <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                Reply
                        </button>
                    </div>

                    <div 
                        v-if="activeReply === reply.id" 
                        class="flex justify-end py-2 px-4 mt-6 bg-white rounded-lg rounded-t-lg border-b border-gray-200"
                    >

                        <input 
                        v-model="replyToComment"
                        class="w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                        placeholder="Add reply..."
                        required>

                        <div class="flex items-center pl-3">
                            <button 
                                @click="userReply(reply.id)"
                                class="flex items-center text-sm text-gray-500 hover:underline"
                                :disabled="replyToComment.length < 1"
                            >
                                    Send
                                    <svg class="mr-1 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.8160000000000001"></g><g id="SVGRepo_iconCarrier"> <path d="M20 12L4 4L6 12M20 12L4 20L6 12M20 12H6" stroke="#000000" stroke-width="0.384" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </button>
                        </div>
                    </div>


                    <article v-for="reply in reply.replies" :key="reply.id" class="p-6 ml-12 lg:ml-24 text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900">{{ reply.user?.name }}</p>
                                <p class="text-sm text-gray-600">{{ new Date(reply.created_at).toLocaleString() }}</p>
                            </div>
                        </footer>

                        <p class="text-gray-500">{{reply.body}}</p>

                    </article>
                </article>
                <hr class="border-2 mt-6">
            </article>
        </div>
    </section>
</template>

