<form action="/resume/analyze" method="POST">
    @csrf

    <textarea name="resume_text" rows="10" class="border w-full p-2" placeholder="Paste resume text"></textarea>
    <input type="text" name="job_role" class="border w-full p-2 mt-2" placeholder="Job Role">
    <button class="bg-blue-600 text-white px-4 py-2 mt-3">Analyze</button>
</form>
