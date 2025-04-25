<div class="flex min-h-screen flex-col">
    <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-sm">
            <div class="flex flex-col items-center space-y-2 text-center">
                <a href="index.php" class="flex items-center gap-2 font-bold">
                    <i class="fas fa-book-open h-6 w-6"></i>
                    <span>AskAway</span>
                </a>
                <h1 class="text-2xl font-bold">Log in to your account</h1>
                <p class="text-sm text-gray-500">Enter your credentials to access your account</p>
            </div>
            <div class="mt-8">
                <form action="" method="POST" class="space-y-6">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="m@example.com">
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <button type="submit" name="login" class="btn w-full bg-blue-500 hover:bg-blue-600 text-white">
                        Log in
                    </button>
                    <div class="text-center text-sm">
                        Don't have an account? 
                        <a href="signup.php" class="text-blue-600 hover:text-blue-500">
                            Sign up
                        </a>
                    </div>
                    <div class="text-center text-sm mt-4">
                        <a href="/Coursework_copy/admin/login.php" class="btn btn-secondary">
                            <i class="fas fa-user-shield mr-2"></i> Admin Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 