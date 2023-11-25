import {ref} from 'vue';
import axios from 'axios';

export default function useChat() {
    const messages = ref([]);
    const errors = ref([]);

    const getMessages = async () => {
        await axios.get('/messages').then((response) => {
            messages.value = response.data;
        }).catch((error) => {
            console.log(error);
        });
    };

    const addMessage = async (form) => {
        errors.value = [];

        await axios.post('/send', form).then((response) => {
            messages.value.push(response.data);
        }).catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else {
                console.log(error);
            }
        });
    };

    return {
        messages,
        errors,
        getMessages,
        addMessage,
    };
}
