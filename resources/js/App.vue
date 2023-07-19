<template>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="alert alert-info" v-if="successRegistration">Ви успішно зареєструвалися</div>
        <div class="card w-50 p-3" v-else>
            <h1>Реєстрація</h1>
            <form @submit.prevent="register">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Ім'я</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{'is-invalid': hasErrors('first_name')}"
                        id="first_name"
                        v-model="form.firstName"
                    >
                    <div class="invalid-feedback" v-if="hasErrors('first_name')">
                        <span v-for="(message, index) in errors.first_name" :key="`first_name-${index}`">
                            {{ message }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Прізвище</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{'is-invalid': hasErrors('last_name')}"
                        id="last_name"
                        v-model="form.lastname"
                    >
                    <div class="invalid-feedback" v-if="hasErrors('last_name')">
                        <span v-for="(message, index) in errors.last_name" :key="`last_name-${index}`">
                            {{ message }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{'is-invalid': hasErrors('email')}"
                        id="email"
                        v-model="form.email"
                    >
                    <div class="invalid-feedback" v-if="hasErrors('email')">
                        <span v-for="(message, index) in errors.email" :key="`email-${index}`">
                            {{ message }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': hasErrors('password')}"
                        id="password"
                        v-model="form.password"
                    >
                    <div class="invalid-feedback" v-if="hasErrors('password')">
                        <span v-for="(message, index) in errors.password" :key="`password-${index}`">
                            {{ message }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Повторіть пароль</label>
                    <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': hasErrors('password_confirmation')}"
                        id="password_confirmation"
                        v-model="form.passwordConfirmation"
                    >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import RegistrationService from './services/RegistrationService.js'

export default {
    data: () => ({
        form: {
            firstName: '',
            lastname: '',
            email: '',
            password: '',
            passwordConfirmation: ''
        },
        successRegistration: false,
        errors: {}
    }),
    methods: {
        async register() {
            await RegistrationService.registration({
                first_name: this.form.firstName,
                last_name: this.form.lastname,
                email: this.form.email,
                password: this.form.password,
                password_confirmation: this.form.passwordConfirmation
            })
                .then(response => {
                    this.errors = response.errors

                    this.successRegistration = response.status || false

                    if (!this.successRegistration) {
                        this.errors = response.errors
                    }
                })
        },
        hasErrors(field) {
            return this.errors.hasOwnProperty(field) && this.errors[field].length
        }
    }
}
</script>

