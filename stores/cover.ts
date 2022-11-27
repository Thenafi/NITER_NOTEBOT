export const useCoverStore = defineStore('coverStore', {
    state: () => ({
        templates: [
            {
                id: '11qhe5jHiKJ1ZvXbtx32NtgiqHHRP-GANXZlLGj3OUQc',
                name: 'Template 1',
                image: 'https://f000.backblazeb2.com/file/ShareX2022/ShareX/Basic_page-0001.jpg',
                description: 'Basic one with course name and code and submission details.'
            },
            {
                id: '1Ahp-NEc9gn_5Ii6CkknRhVbIwKAuokZUTVnYPFdCC9M',
                name: 'Template 2',
                image: 'https://f000.backblazeb2.com/file/ShareX2022/ShareX/exp%20and%20date_page-0001.jpg',
                description: 'Includes Experiment name, code ,date and submission date.'
            }
        ]
        ,
        selectedTemplate: ''
    }),
    actions: {
        setTemplate(docID: string) {
            this.selectedTemplate = docID
        },
        getTemplate(docID: string) {
            for (let index = 0; index < this.templates.length; index++) {
                const element = this.templates[index];
                if (element.id === docID) return element

            }
        }

    }

})

