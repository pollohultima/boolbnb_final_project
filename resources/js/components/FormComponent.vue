<template>
    <div class="message_sec">
        <h2>Invia un messaggio</h2>
        <form action="../api/messages" method="POST" @submit.prevent="sendMessage()">
            <div class="d-flex flex-column">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input
                        type="text"
                        name="name"
                        v-model="name"
                        id="name"
                        class="form-control"
                        placeholder="Inserisci il tuo nome"
                    />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        name="email"
                        v-model="email"
                        id="email"
                        class="form-control"
                        placeholder="Inserisci il tuo indirizzo email"
                    />
                </div>

                <div class="form-group">
                    <label for="content">Messaggio</label>
                 
                     <textarea
                         name="content"
                        v-model="content"
                        id="content"
                        class="form-control textarea p-2"
                        placeholder="Inserisci il tuo messaggio"
                        cols="30"
                        rows="10"
                        
                ></textarea>
                </div>

                
             

                <!--  <label for="message" class="mt-3"
                                    >il tuo messaggio</label
                                >
                                <textarea
                                    name="message"
                                    id="message"
                                    cols="30"
                                    rows="10"
                                    class="textarea p-2"
                                ></textarea> -->
            </div>
            <div class="form-group">
                <input type="submit" value="Invia" class="button mt-4" />
            </div>
        </form>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    props: ['apartment_id'],

    data() {
        return{
            name: '',
            email: '',
            content: '',
        }
        
    },

    methods: {
        sendMessage() {
            Axios.post('../api/messages', {name:this.name, email:this.email, content:this.content, apartment_id:this.apartment_id });
            alert('messaggio inviato')

            this.name = '',
            this.email = '',
            this.content = ''
        },
    },
};
</script>
