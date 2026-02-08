import axios from 'axios'

export async function createUser(payload) {
    return axios.post('/api/user', payload)
}
