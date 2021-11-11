<template>
    <div id="app" class="container mx-8">
        <div class="mt-5">
            <div ref="uppy" />
            <pre>
                {{ user }}
            </pre>
            <label for="">Nome</label>
            <input
                v-model="user.name"
                type="text"
                class="form-control"
            >

            <br>
            <img
                :src="imageSrc"
                alt=""
                width="100"
            >
            <br>
            <label for="">Avatar</label>
            <input
                type="file"
                class="form-control"
                @change="getAvatar"
            >

            <br>

            <label for="">Email</label>
            <input
                v-model="user.email"
                type="text"
                class="form-control"
            >

            <br>

            <label for="">Telefone</label>
            <input
                v-model="user.phone"
                type="text"
                class="form-control"
            >

            <br>

            <button
                class="btn btn-primary"
                @click="submit"
            >
                ENVIAR
            </button>
        </div>
    </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue'
import axios from 'axios'
import Uppy from '@uppy/core';
import DragDrop from '@uppy/drag-drop';
import XHRUpload from '@uppy/xhr-upload';

import '@uppy/core/dist/style.css'
import '@uppy/drag-drop/dist/style.css'

export default {
    name: 'App',
    components: {
        HelloWorld
    },

    data() {
        return {
            uppy: null,
            user: {
                name: '',
                avatar: '',
                email: '',
                phone: '',
            },
        }
    },

    mounted() {
        this.uppy = new Uppy({
            autoProceed: true,
        })
            .use(DragDrop, {
            target: this.$refs.uppy,
            width: '100%',
            height: '100%',
        })
            .use(XHRUpload, {
                endpoint: 'http://localhost:8000/api/users/1/avatar',
                fieldName: 'avatar'
            })

    },


    computed: {
        imageSrc() {
            return this.user.avatar ? URL.createObjectURL(this.user.avatar) : null;
        },
    },

    methods: {
        getAvatar($evt) {
            this.user.avatar = $evt.target.files[0];
        },

        submit() {
            const payload = new FormData();
            payload.append('name', this.user.name);
            payload.append('avatar', this.user.avatar);
            payload.append('email', this.user.email);
            payload.append('phone', this.user.phone);

            axios.post('http://localhost:8000/api/users', payload)
        }
    },
}
</script>

<style>
</style>
