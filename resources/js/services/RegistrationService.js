import axios from '../plugins/axios.js'

class RegistrationService {
    async registration(formData) {
        return await axios.post('registration', formData)
            .then(response => {
                return response.data
            }).catch(error => {
                return error.response.data
            })
    }
}

export default new RegistrationService()
