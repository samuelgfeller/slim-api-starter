// Get the second segment of the url for the case that the application is not running in the root directory
// (e.g. localhost/my-app) -> basePath = 'my-app'
const secondUrlSegment = window.location.pathname.split('/')[1];
// If the project is stored in the root directory, the second segment is the 'frontend' folder which means
// that the base path is empty.
const basePath = secondUrlSegment !== 'frontend' ? `/${secondUrlSegment}` : '';
// Replace with the correct API url
const url = basePath + '/users';
document.getElementById('request-users-btn').addEventListener('click', () => {
    // Make Ajax request to fetch users
    fetch(url, {method: 'GET', headers: {"Content-type": "application/json"}})
        .then(async response => {
            const outputContainer = document.getElementById('request-output');
            // Output container is hidden by default, remove inline display: none property
            outputContainer.style.display = null;
            // Add success class to output container by default
            outputContainer.className = 'success';

            // Add red line border output if response is not between 200 and 299
            if (!response.ok) {
                outputContainer.className = 'error';
                console.log(response.status)
                if (response.status === 404) {
                    outputContainer.innerHTML = `Invalid API url: ${url}`;
                    return;
                }
                outputContainer.innerHTML = `Error: ${response.status} ${response.statusText}`;
                return;
            }

            // Parse the JSON response
            const jsonResponse = await response.json();
            // Pretty print the JSON response
            const prettyJson = JSON.stringify(jsonResponse, null, 2);
            // Display the JSON response in the output container
            outputContainer.innerHTML = prettyJson
                // Replace newlines with <br> and remove \r, \" and \\
                .replace(/\\n/g, '<br>')
                .replace(/\\r/g, '')
                .replace(/\\"/g, '\"')
                .replace(/\\\\/g, '\\');
        });
});