<div class="py-12">
    <div class="container px-4 md:px-6">
        <div class="mx-auto max-w-4xl space-y-8">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold">Contact Us</h1>
                <p class="text-gray-500">Have questions or need assistance? Reach out to our team.</p>
            </div>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="text-xl font-bold">Get in Touch</h2>
                        <p class="text-gray-500">
                            Fill out the form and our team will get back to you as soon as possible.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope h-5 w-5 text-gray-500"></i>
                            <div>
                                <h3 class="font-medium">Email</h3>
                                <p class="text-sm text-gray-500">support@questiondb.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-phone h-5 w-5 text-gray-500"></i>
                            <div>
                                <h3 class="font-medium">Phone</h3>
                                <p class="text-sm text-gray-500">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <form action="" method="POST" class="space-y-4">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Your name">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Your email">
                        </div>
                        <div class="space-y-2">
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="How can we help you?">
                        </div>
                        <div class="space-y-2">
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Please provide details about your inquiry..."></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn w-full bg-blue-500 hover:bg-blue-600 text-white">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.error-messages {
    background-color: #ffebee;
    border: 1px solid #ef9a9a;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 10px;
}

.error {
    color: #c62828;
    margin: 5px 0;
}

.success-message {
    background-color: #e8f5e9;
    border: 1px solid #a5d6a7;
    border-radius: 4px;
    color: #2e7d32;
    margin-bottom: 20px;
    padding: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>