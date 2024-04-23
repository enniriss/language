function generator() {
    console.log("telecharger");
    const element = document.getElementById("evaluation");
    const options = {
        filename: 'page.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'credit-card', orientation: 'landscape' }
    };
    html2pdf()
    .set(options)
    .from(element)
    .save();
}