function validateCashin() {
    let cashinAmount = document.getElementById("cashinAmount").value;

    if (cashinAmount < 100) {
        return false;
    } else {
        cashin();
    }
}

async function cashin() {
    let cashinAmount = document.getElementById("cashinAmount").value;
    // 0.1 ETH = 100
    let finalETH = cashinAmount / phpRate;
    finalETH = Number(finalETH.toFixed(7));
    console.log(finalETH);
    // Check if MetaMask is installed
    if (typeof window.ethereum !== "undefined") {
        // Request account access
        await ethereum.request({
            method: "eth_requestAccounts",
        });

        console.log(window.ethereum);
        console.log(finalETH);

        // Create a provider and signer
        const provider = new ethers.BrowserProvider(window.ethereum);
        const signer = await provider.getSigner();

        // Define the contract ABI and address (replace with your deployed contract address)

        // Create a contract instance
        const aidContract = new ethers.Contract(
            contractAddress,
            contractABI,
            signer
        );
        

        // Set the transaction parameters (e.g., cashin 0.1 ETH)
        const transaction = await aidContract.addScholarRecord(
            parseInt(uid),
            ethers.parseEther(`${finalETH}`),
            "Cashin",
            {
                value: ethers.parseEther(`${finalETH}`), // Send 0.1 ETH as part of the transaction,
            }
        );

        // Wait for the transaction to be confirmed
        await transaction.wait();

        let thash = document.getElementById("thash");
        thash.value = transaction.hash;

        let tfrom = document.getElementById("tfrom");
        tfrom.value = transaction.from;

        let tto = document.getElementById("tto");
        tto.value = transaction.to;

        let eth = document.getElementById("eth");
        eth.value = finalETH;

        let addDonationForm = document.getElementById("cashinForm");
        addDonationForm.removeAttribute("onsubmit");

        let btnAddDonation = document.getElementById("btnAddCash");
        btnAddDonation.click();
    } else {
        console.error("MetaMask is not installed.");
    }
}
