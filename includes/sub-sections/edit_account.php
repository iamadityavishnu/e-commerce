<div class="edit-account">
    <form action="my_account.php" method="POST">
        <h3>Edit account details</h3>
        <table>
            <tr>
                <td>
                    <label>Name:</label><br />
                    <input
                        type="text"
                        name="name"
                        value="<?php echo $cust_name; ?>"
                        placeholder="John Doe"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email:</label><br />
                    <input
                        type="email"
                        name="email"
                        value="<?php echo $cust_email; ?>"
                        placeholder="example@example.com"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Phone:</label><br />
                    <input type="number" name="phone" value="<?php echo $cust_phone; ?>"
                    placeholder="Eg: 61399476640" required min="0"
                    <?php if(isset($_SESSION['email'])){ echo "autofocus"; } ?>>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Address line 1:</label><br />
                    <input
                        type="text"
                        name="add1"
                        value="<?php echo $cust_add1; ?>"
                        placeholder="Street name"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Address line 2:</label><br />
                    <input
                        type="text"
                        name="add2"
                        value="<?php echo $cust_add2; ?>"
                        placeholder="Suburb"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label>State:</label><br />
                    <input
                        type="text"
                        name="state"
                        value="<?php echo $cust_state; ?>"
                        placeholder="State"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Post code:</label><br />
                    <input
                        type="number"
                        name="post-code"
                        value="<?php echo $post_code; ?>"
                        placeholder="Eg: 6109"
                        min="0"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    <input type="submit" name="update-account" value="Update" />
                </td>
            </tr>
        </table>
    </form>
</div>
