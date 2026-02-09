import {reactive, ref} from 'vue'
import {validateUserForm} from '@/validators/userFormValidator'
import {createUser} from '@/services/userApi'

export function useUserWizard() {
    const step = ref(1)
    const errors = ref({})
    const submittedData = ref(null)

    const formData = reactive({
        user: {
            name: '',
            surname: '',
            birthday: ''
        },
        contact: {
            email: '',
            phone: ''
        },
        workExperiences: [
            {
                company: '',
                position: '',
                dateFrom: '',
                dateTo: ''
            }
        ]
    })

    const nextStep = () => {
        errors.value = {}
        step.value++
    }

    const prevStep = () => {
        step.value--
    }

    const addWorkExperience = () => {
        formData.workExperiences.push({
            company: '',
            position: '',
            dateFrom: '',
            dateTo: ''
        })
    }

    const removeWorkExperience = (index) => {
        if (formData.workExperiences.length > 1) {
            formData.workExperiences.splice(index, 1)
        }
    }

    const submit = async () => {
        errors.value = validateUserForm(formData)

        if (Object.keys(errors.value).length) {
            return
        }

        try {
            await createUser(formData)
            submittedData.value = formData
            step.value = 4
        } catch (e) {
            if (e.response?.status === 422) {
                errors.value = e.response.data
            } else {
                errors.value = {global: ['Server error']}
            }
        }
    }

    return {
        step,
        formData,
        errors,
        submittedData,
        nextStep,
        prevStep,
        addWorkExperience,
        removeWorkExperience,
        submit
    }
}
