export function validateUserForm(data) {
    const errors = {}

    if (!data.user.name) {
        errors['user.name'] = ['First name is required']
    }

    if (!data.user.surname) {
        errors['user.surname'] = ['Last name is required']
    }

    if (!data.user.birthday) {
        errors['user.birthday'] = ['Birthday is required']
    } else if (new Date(data.user.birthday) >= new Date()) {
        errors['user.birthday'] = ['Birthday must be in the past']
    }

    if (!data.contact.email) {
        errors['contact.email'] = ['Email is required']
    } else if (!/^\S+@\S+\.\S+$/.test(data.contact.email)) {
        errors['contact.email'] = ['Invalid email format']
    }

    const phoneRegex = /^\+?[0-9]{9,15}$/

    if (!data.contact.phone) {
        errors.phone = ['Phone is required']
    } else if (!phoneRegex.test(data.contact.phone)) {
        errors.phone = ['Phone number must contain 9–15 digits and may start with +']
    }

    if (!data.workExperiences.length) {
        errors['workExperiences'] = ['At least one work experience is required']
    }

    data.workExperiences.forEach((w, i) => {
        if (!w.company) {
            errors[`workExperiences.${i}.company`] = ['Company is required']
        }
        if (!w.position) {
            errors[`workExperiences.${i}.position`] = ['Position is required']
        }
        if (!w.dateFrom) {
            errors[`workExperiences.${i}.dateFrom`] = ['Start date is required']
        }
        if (!w.dateTo) {
            errors[`workExperiences.${i}.dateTo`] = ['End date is required']
        }
        if (w.dateFrom && w.dateTo && w.dateFrom > w.dateTo) {
            errors[`workExperiences.${i}.dateFrom`] = ['Start date must be before end date']
        }
    })

    return errors
}
