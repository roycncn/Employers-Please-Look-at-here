import java.io.FileNotFoundException;
import java.util.ArrayList;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class ChangeOrder {
	String CRNum = null;
	String PlanID = null;
	String ViewState = null;
	String cookie = null;
	List<Task> CRTask = new ArrayList<Task>();

	public ChangeOrder(String num, String PlanID, String ViewState, String planPage, String cookie) {
		this.CRNum = num;
		this.PlanID = PlanID;
		this.ViewState = ViewState;
		this.cookie = cookie;
		this.CRTask = TaskParser(planPage);
	}

	public void PrintText() {
		System.out.println(CRNum);
		for (Task task : CRTask) {
			if (task.ImplanTeam.contains("xxxxxx")) {
				System.out.println(task.getShortName() + ":" + task.TaskSummary);
			}

		}

	}

	public void DownloadZip() throws FileNotFoundException, InterruptedException {
		for (Task task : CRTask) {
			if (task.AttachName.length() > 1 && task.ImplanTeam.contains("xxxxxx")) {

				task.AttachDownload();
			}
		}

	}

	public List<Task> TaskParser(String content) {
		List<Task> tempList = new ArrayList<Task>();
		Document doc = Jsoup.parse(content);
		Element ele = doc.getElementById("taskListTable");
		Elements rows = ele.getElementsByTag("tr");

		for (int i = 0; i < rows.size(); i = i + 2) {

			Element row = rows.get(i);
			Task temp = new Task();
			temp.CRNum = CRNum;
			temp.cookie = cookie;
			temp.ViewState = ViewState.replace("\"", "");
			temp.TaskNum = row.getElementsByTag("td").get(1).text();
			temp.TaskSummary = row.getElementsByTag("td").get(2).text();
			temp.ImplanTeam = row.getElementsByTag("td").get(3).text();
			temp.TaskStartTime = row.getElementsByTag("td").get(4).text().replace(":", "").substring(11, 15);
			temp.AttachName = row.getElementsByTag("td").get(7).text();
			if (temp.AttachName.length() > 1 && !temp.TaskNum.equals("1")) {

				String temp1 = row.getElementsByTag("td").get(7).toString();
				temp.AttachString = temp1.substring(temp1.indexOf("j_id_jsp"), temp1.indexOf("j_id_jsp") + 29)
						.replace("\\", "");
			}
			if(temp.AttachName.length() > 1 && temp.TaskNum.equals("1")){

				String temp1 = row.getElementsByTag("td").get(7).toString();
				temp.AttachString = temp1.substring(temp1.indexOf("j_id_jsp"), temp1.indexOf("j_id_jsp") + 23)
						.replace("\\", "");
				
			}

			tempList.add(temp);

		}

		return tempList;

	}

}
