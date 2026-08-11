async function receiveFund(amount, ownerID, paymentAddress, rpcURL) {
    if (typeof window.ethereum !== "undefined") {
        console.log("...");
        // Set up the provider to connect to the local Hardhat node
        const provider = new ethers.JsonRpcProvider(rpcURL);

        try {
            // Use the provider to create a signer for transaction sending
            const signer = new ethers.Wallet(pk, provider);
            // const signer = await provider.getSigner();

            // Connect to the smart contract
            const contract = new ethers.Contract(
                contractAddress,
                contractABI,
                signer
            );
            console.log(
                `Sending funds from ownerID: ${ownerID}, amount: ${amount}, to receiver: ${paymentAddress}`
            );
            let finalETH = amount / phpRate;
            finalETH = Number(finalETH.toFixed(7));
            // Convert the amount to Wei for the transaction
            const amountInWei = ethers.parseEther(`${finalETH}`);
            // const ownerIDBytes32 = ethers.encodeBytes32String(ownerID);
            // console.log("Encoded ownerID:", ownerIDBytes32);
            console.log(amountInWei);

            // Call the `receiveFunds` function in the smart contract
            const tx = await contract.receiveFunds(
                ownerID,
                amountInWei,
                "e6c9b3c7-3723-454d-9b76-b9197f0e24cb",
                paymentAddress,
                {
                    value: amountInWei,
                    gasLimit: 300000, // Ensure sufficient gas
                }
            );

            // Wait for the transaction to be mined
            const receipt = await tx.wait();
            console.log("Funds sent successfully:", receipt);
            setTimeout(() => {
                let disbursedStudentID =
                    document.getElementById("disbursedStudentID");
                disbursedStudentID.value = sid;
                let disbursedAmount =
                    document.getElementById("disbursedAmount");
                disbursedAmount.value = amount;

                let orgForm = document.getElementById("orgForm");
                orgForm.removeAttribute("onsubmit");
                let disbursedETH = document.getElementById("disbursedETH");
                disbursedETH.value = amountInWei;

                let disbursedThash = document.getElementById("disbursedThash");
                disbursedThash.value = receipt.hash;

                let btnApproveWithDisburse = document.getElementById(
                    "btnApproveWithDisburse"
                );
                btnApproveWithDisburse.click();
            }, 500);
        } catch (error) {
            console.log("Error sending funds:", error);
            let btnCloseLoading = document.getElementById("btnCloseLoading");
            btnCloseLoading.click();
            let orgForm = document.getElementById("orgForm");
            orgForm.removeAttribute("onsubmit");
            let btnApprove = document.getElementById("btnApprove");
            btnApprove.click();
        }
    } else {
        console.log("Ethereum wallet is not connected.");
        let btnCloseLoading = document.getElementById("btnCloseLoading");
        btnCloseLoading.click();
        let orgForm = document.getElementById("orgForm");
        orgForm.removeAttribute("onsubmit");
        let btnApprove = document.getElementById("btnApprove");
        btnApprove.click();
    }
}
